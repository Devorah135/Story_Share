const express = require('express');
const bodyParser = require('body-parser'); // Added for handling form data
const nodemailer = require('nodemailer');

const app = express();
const port = 3000;

app.use(bodyParser.urlencoded({ extended: true })); // Configure body-parser

function handleFormSubmission(req, res) {
    const { name, email, message } = req.body; // Extract data from request body

    // Validate email (optional)

    const emailContent = `Name: ${name || 'N/A'}\nEmail: ${email}\nMessage: ${message}`;
    const transporter = nodemailer.createTransport({
        service: 'gmail',
        auth: {
            user: 'storyshare385@gmail.com', // Actual email
            pass: 'welove358' // Password
        }
    });

    transporter.sendMail({
        from: 'storyshare385@gmail.com',
        to: 'storyshare385@gmail.com',
        subject: 'StoryShare Contact Us Submission',
        text: emailContent
    }, (error) => {
        if (error) {
            console.error(error);
            res.status(500).send('Error sending email. Please try again later.');  // Send error response
        } else {
            console.log('Email sent!');
            res.status(200).send('Form submitted successfully!'); // Send success response
        }
    });
}

app.get('/', (req, res) => {
    res.send('Welcome to the StoryShare Contact Form!');
});

app.post('/submit', handleFormSubmission);

app.listen(port, () => {
    console.log(`Server listening on port ${port}`);
});
