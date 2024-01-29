// controllers/userAuthController.js
const jwt = require('jsonwebtoken');
const db = require('../model/db');
const { promisify } = require('util');

exports.login = async (req, res) => {
    const { school_id, password } = req.body;

    // 1) Check if the school_id and password exist
    if (!school_id || !password) {
        return res.status(400).render("user_login", {
            message: 'Please provide School ID and Password'
        });
    }

    // 2) Check if user exists && password is correct
    db.query('SELECT * FROM user_credentials WHERE school_id = ?', [school_id], async (error, results) => {
        // Check if results is defined and not empty
        if (!results || results.length === 0) {
            return res.status(401).render("user_login", {
                message: 'Incorrect school id or password'
            });
        }

        const isMatch = password === results[0].password;

        console.log('Entered Password:', password);
        console.log('Stored Password:', results[0].password);
        console.log('isMatch:', isMatch);

        if (!results || !isMatch) {
            return res.status(401).render("user_login", {
                message: 'Incorrect school id or password'
            });
        } else {
            // Redirect to /user_dashboard on successful login
            res.status(200).redirect("/user_dashboard");
        }
    });
};

exports.isLoggedIn = async (req, res, next) => {
    console.log(req.cookies);
    if (req.cookies.jwt) {
        try {
            // 1) Verify Token
            const decoded = await promisify(jwt.verify)(
                req.cookies.jwt,
                process.env.JWT_SECRET
            );
            console.log("decoded");
            console.log(decoded);

            // 2) Check if user still exists
            db.start.query('SELECT * FROM user_credentials WHERE school_id = ?', [decoded.id], (error, result) => {
                console.log(result)
                if (!result) {
                    return next();
                }
                // THERE IS A LOGGED IN USER
                req.user = result[0];
                console.log("next")
            });
        } catch (err) {
            return next();
        }
    } else {
        next();
    }
};

exports.contact_admin = (req, res) => {
    res.render('contact_admin');
};

exports.user_dashboard = (req, res) => {
    try {
        // Query to fetch all transactions
        var queryTransactions = "SELECT * FROM transactions";

        // Query to count available rooms
        var queryRoomCount = 'SELECT COUNT(*) as count FROM rooms WHERE room_status = "available"';

        // Query to count available equipments
        var queryEquipCount = 'SELECT COUNT(*) as count FROM equipments WHERE equip_status = "available"';

        // Executing the queries
        db.query(queryTransactions, (errorTransactions, dataTransactions) => {
            if (errorTransactions) {
                console.error('Error executing transactions query:', errorTransactions);

            }


            db.query(queryRoomCount, (errorRoomCount, dataRoomCount) => {
                if (errorRoomCount) {
                    console.error('Error executing room count query:', errorRoomCount);
                    return res.status(500).send('Internal Server Error');
                }

                db.query(queryEquipCount, (errorEquipCount, dataEquipCount) => {
                    if (errorEquipCount) {
                        console.error('Error executing equipment count query:', errorEquipCount);
                        return res.status(500).send('Internal Server Error');
                    }

                    res.render('user_dashboard', {
                        transactions: dataTransactions,
                        roomResult: dataRoomCount[0].count || 0,
                        equipResult: dataEquipCount[0].count || 0
                    });
                });
            });
        });

    } catch (error) {
        console.error('Error:', error.message);
        res.status(500).send('Internal Server Error');
    }
}

exports.rooms = (req, res) => {
    var query = "SELECT * FROM rooms";

    db.query(query, (error, data) => {
        if (error) {
            console.error('Error executing query:', error);
            return res.status(500).send('Internal Server Error');
        }

        res.render('rooms', {
            rooms: data
        });
    });
}

exports.room_order = (req, res) => {
    var id_number = req.body.id_number;
    var first_name = req.body.first_name;
    var last_name = req.body.last_name;
    var contact_number = req.body.contact_number;
    var school_email = req.body.school_email;
    var query = `
    INSERT INTO transactions (user_id,first_name, last_name, contact_number, school_email),
    VALUES("${user_id}","${first_name}","${last_name},"${contact_number}","${school_email})`;

    db.query(query, function (error, data) {
        if (error) {
            throw error;
        }
        else {
            res.redirect("/rooms");
        }
    });
    res.render('rooms', {
        action: 'rent',
    })
}

exports.equipments = (req, res) => {
    var query = "SELECT * FROM equipments";

    db.query(query, (error, data) => {
        if (error) {
            console.error('Error executing query:', error);
            return res.status(500).send('Internal Server Error');
        }

        res.render('equipments', {
            equipments: data
        });
    });
}


exports.logout = (req, res) => {
    res.cookie('jwt', 'loggedout', {
        maxAge: 10 * 1000,
        httpOnly: true
    });
    res.status(200).redirect("/user_login");
};