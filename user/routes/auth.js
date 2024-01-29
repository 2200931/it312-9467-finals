// routes/router.js
const express = require('express');
const authController = require('../controllers/auth.js');
const router = express.Router();

// Post Pages
router.post('/user_login', authController.login);
router.post('/contact_admin', authController.contact_admin);
router.post('/user_dashboard', authController.login);

// Get Pages
router.get('/rooms', authController.rooms);
router.get('/contact_admin', authController.contact_admin);
router.get('/equipments', authController.equipments);
router.get('/logout', authController.logout);

module.exports = router;