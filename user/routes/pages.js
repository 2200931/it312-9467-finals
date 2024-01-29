// routes/pages.js
const express = require('express');
const authController = require('../controllers/auth');

const router = express.Router();

router.get(['/', '/user_login'], authController.isLoggedIn, authController.login);
router.get('/user_dashboard', authController.isLoggedIn, authController.user_dashboard);
router.get('/contact_admin', authController.isLoggedIn, authController.contact_admin);
router.get('/rooms', authController.isLoggedIn, authController.rooms);
router.get('/equipments', authController.isLoggedIn, authController.equipments);

module.exports = router;
