# secure_message_app
secure_message_app

**Purpose of this app:**
**1. Landing Page:**
Upon accessing the application, users are directed to the index page.
The index page provides intuitive navigation options:
"Read Message": Enables users to securely retrieve and view encrypted messages.
"Send Message": Empowers users to share encrypted messages with designated recipients.
"Set Key": Facilitates the establishment of user details, including name, email, and decryption key.
**2. Set User:**
Users initiate the "Set Key" process by selecting the corresponding button on the index page.
They are directed to a dedicated "Set Key" page to input personalized details:
Name: Distinctive identifier for the user within the system.
Email: User's email address for communication purposes.
Decryption Key: Unique key for decrypting messages.
Submitted user details are securely stored in the database for future reference.
**3. Send Message:**
Users navigate to the "Send Message" functionality from the index page.
They compose and dispatch a new encrypted message on the "Send Message" page.
Input includes message content and recipient's email.
Upon submission, the message undergoes encryption using AES-256-CBC encryption algorithm.
The encrypted message, along with relevant details, is securely stored in the application's database.
**4. Retrieve Message:**
Recipients access the "Retrieve Message" feature from the index page.
They are directed to the "Read Message" page for message retrieval and decryption.
Input includes unique email ID and decryption key provided by the sender.
The application retrieves the encrypted message associated with the provided email ID.
Leveraging the recipient's decryption key, the message is securely decrypted within the application.
Once decrypted, the message content is presented to the recipient for viewing.
Message status is updated in the database, indicating successful viewing by the recipient.

**Step to Step guide to use it:**

**Step 1: Set Up Local Environment**
Install a local server environment like XAMPP, WAMP, or MAMP depending on your operating system.
Start the local server and ensure that PHP and MySQL are running properly.

**Step 2: Create a Database**
Open your preferred database management tool (e.g., phpMyAdmin).
Create a new database. You can name it according to your project requirements.

**Step 3: Connect Database to db/conn.php File**
Navigate to the db/conn.php file in your project directory.
Update the database connection details (hostname, username, password, and database name) in this file to match your local environment.

**Step 4: Execute Schema Files**
Locate the provided schema files message_table.sql and users.sql.
Open each file and copy its contents.
Open your database management tool and select the database you created earlier.
Paste the SQL queries from message_table.sql and users.sql into the SQL query editor.
Execute each SQL query to create the necessary tables in your database.

**Step 5: Verify Database Setup**
Verify that the tables message_table and users have been successfully created in your database.

With these steps, you should have successfully set up a local environment for your PHP project, created a database, connected it to your project, and created the required tables using the provided schema files.
