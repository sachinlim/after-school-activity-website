<img align="right" src="https://cdn-icons-png.flaticon.com/512/5044/5044729.png" width="100">
<img align="right" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/1200px-PHP-logo.svg.png" width="100">

# After School Activities Website

While growing up in the UK, I was able to see the different methods that teachers had implemented to handle the activities in the school. In my last school, the teacher that was managing all the activities was manually entering information onto an Excel spreadsheet and making changes as needed. The gathering of information was all done on paper, where another teacher would verbally ask the students what activity they wanted to do and then write their response down before handing them over.

This project makes use of the facilities available for online applications and tackles the issues some schools may have where applications for after school activities may still be done by hand, requiring many more hours after students have given their choices. A database built around MySQL has been at the epicentre of this project, allowing me to achieve the vital features that I wanted in order to create a functioning website using mostly HTML, PHP and CSS.

The website will contain a list of clubs and activities that are available for students to choose from, all being stored on the database. All of the students from the school are granted an account that they can log-in with and pick the activities on offer. An administrator will also exist who will oversee and manage the selections to make sure everyone is properly allocated, just like how it is currently done. The teachers that are supervising the activities are able to view the students in their club and have the same experience as before.

---

As this project was initially hosted on GitLab, the original commit history is not available. This repository contains the files associated with the project.


## Project Aims

- Make it an online system that could be deployed on the cloud
- Allow accounts to exist with security in mind
- Have an administrator account(s) to manage this system
- Enable mobile phone and tablet access
- Enforce encryption to the data being stored
- Generate PDF printouts for teachers for their activities


## Key Features

The [Notes](Notes) directory will provide additional information that is involved with this project.


### Creation of Users

Users can always be added onto the database, but it can only be done by the Admin. The Admin is the person who is in charge of the website, and therefore, it would make sense to only allow them to be able to do this part and not others like teachers. When the Admin logs in, the “users” table gets decrypted, allowing them to make changes, and all of the users in the database are shown in the homepage. To add a user onto the database and into the “users” table, the Admin will need just a few details about the user.

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208976131-02ded6ae-b0e2-4a5a-ae67-7738203f186b.png" width="900"/>
</p>

There is a “form” which contains input boxes that takes in 6 details: first name, surname, email, date of birth, password, and the user type. The input boxes for first name and surname all have auto-capitalisation tool in place to capitalise the first letter of each word. All of the details will get pushed onto the “users” table by doing an `UPDATE` query, but the password will get hashed before being sent over. The query is also a prepared statement to make sure there are no events of SQL injection happening.


### Creation of Activities 

Creation of Clubs and Activities works in the same fashion as creating a new user. A table that contains all of the Clubs and Activities in the database gets shown to the Admin and they are able to add and remove them in the same manner as users.

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208976311-76fbb4d4-2a71-4d00-a8ce-0b73fdedc354.png" width="775"/>
</p>

Clubs can be created with the form on the left and can be deleted with the Delete button on the table. Clicking the link under the Submit button or the link in the navigation bar takes the Admin to see all of the current supervisors/Teachers.


### Logging In

The logging in system is the part of the website that differentiates each user to be able to correctly allocate students to the right activities. When the user wants to gain access to the website, it may be done via a link from the school’s website or an email link that was sent out to all students. 

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208976541-c9de99e9-ea11-4188-a6cc-d4ff6d4d334f.png" width="850"/>
</p>


All users will be seeing the same log-in webpage and will have the same requirements to log in: email and password. 


#### Validation

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208976720-6824b640-bef4-4e50-b613-2048c61deef1.png" width="375"/>
</p>

Error messages are properly given out, as shown above, when the wrong email address is entered.

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208976893-ec3bb18b-4501-4c1f-bd82-25b7b0580d43.png" width="375"/>
</p>

When the wrong password is entered, the response, above, is shown.

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208977047-c965ec96-55ba-4c55-aede-fb9cf3fc907f.png" width="800"/>
</p>

If the student is logging in for the first time or they do not have any Clubs selected, they are displayed a message that informs them that they have no Club or Activity selected.


### Selection of Clubs and Activities

Once the students have logged in, after clicking the right links, the students are able to view and select Clubs that they would like to do. 

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208977206-1250f756-db32-48aa-9756-5c46bbeae207.png" width="800"/>
</p>

They are able to use this webpage to select clubs and submit them. Once it has been submitted, it will get added onto the database and will be able to be viewed from the website itself.

#### Validation

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208977396-9b3b0b14-345a-47b1-815e-ab7cec5dc681.png" width="500"/>
</p>

If the student was to have clashes in their club choices, they will be shown a different screen like the message above, where the application will tell them to choose again. There is also a check to see if students have actually selected something or not.

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208977791-46daf932-bd5d-4a9b-942d-9fd694096a23.png" width="800"/>
</p>

If there are no clashes, the student will be redirected to their home screen and their choices will be displayed.


### Session Management

Session management has been done by using the tools that are available with PHP and each visitor is assigned a `unique ID`, also known as a `session ID` - this is stored as a cookie. The session management tools allow us to be able to have more than one user logged in and accessing the webpage. To test this feature out, Google Chrome was used and also had another instance of the website running in Incognito mode.

To start a session, the function `session_start()` is called and is declared right at the beginning of the file, and this means before the HTML tags such as `<!DOCTYPE html>` or `<head>`. It is the session management tools that have been implemented in this project that
allow us to be able to properly handle user accounts with a login system that limits access for unwanted guest but still allow us to have multiple users logged in at the same time.

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208977985-6251a227-99f1-4afe-b62e-7fc00c7dea4a.png" width="700"/>
</p>

There are two different users logged in above (mobile view) who have their own separate Club choices. When going ahead and selecting the Clubs to update them, I can click both "Submit" buttons as fast as I can and still have both of them being saved onto the database.


### Logging Out

In order to log out, the users will simply press the hyperlink (SIGN OUT) at the top-right of the navigation bar and they will be logged out – the session will be destroyed, and the users will be forwarded to the login page. The Admin has a similar set of commands to be able to log out, but it has got a few more lines to encrypt the database before logging out.

Pressing the back button to go back to the previous pages will forward the user to the login page and they will no longer have access to anything else because they are not logged in. If, for some reason, the URL routing system does not force the user back to the login page if they have not logged in, there will still be nothing to show the users on the web pages that they access because there is no information for the system to work with. The LOG OUT link will be replaced with a LOG IN link, which will take the user to the login page. 

If someone else comes and tries to go back to access the website past the login page, they will not be able to get anywhere. By accessing the browser history and pressing some of the links, it would look like there is a way for unwanted users to access the Admin pages. However, URL routing means that they will simply be taken to the login page because they are not logged in.


### Encryption

AES Encryption is implemented for the “users” table and only for that table because of the sensitive information being stored. The “users” table will be encrypted by default and when users want to log in, the email stored in the database gets decrypted before it is checked with the user input.

However, when the Admin logs in, the “users” table will get decrypted to allow the Admin full control over the database from the website. As soon as the Admin logs out, the “users” table is encrypted again. It has been done this way to limit the amount of encryption and decryption processes taking place because when there are a large number of Users stored in the database, it could lead to performance slowdowns. Also, when the Admin is logged in, no one else is able to log into the website because the login system will try to decrypt an already decrypted email address – meaning there will be no match between the two theoretically matching emails addresses.

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208978311-e4698949-4bd0-44a4-a6ac-22dbdc370b17.png" width="750"/>
</p>

The values for each of the columns in the screenshot (via phpMyAdmin) above are being stored as a `varbinary(255)`, allowing us to see some of the values in the encrypted form and providing enough length to allow for it all to fit. Information about Clubs and their descriptions have not been encrypted because it will be public knowledge. The main importance of this project was to encrypt the “users” table and hide information about them being viewed if someone was to gain access to the database.


### Hashing

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208978456-658c4eb4-2dcd-4632-9b16-0bcb2f230ab2.png" width="750"/>
</p>

The other half of the table contains the emails, which are still AES encrypted and stored as `varbinary(255)`, but the password is not being stored in the same format. The password has been hashed and the column values are stored as `varchar(255)` and there is no way to get the original string for the password, which is what we want to negate the chance of passwords being cracked.


### Management of Supervisors

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208978655-1eef8e64-ee03-4840-9145-f26db9177350.png" width="300"/>
</p>

We can see a table in which we can see the Club and also see which user is supervising the club. The Delete button will delete only the supervisor that has been allocated for the Club – they are not deleted from the “users” table.

To add a supervisor for a club, there are two drop-down menus next to the table. For mobile devices, it is above the table, but for desktops, it is to the left.

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208978822-2feb3074-62a6-4564-a8f0-30ac79de6e83.png" width="300"/>
</p>

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208978921-40e75e27-65a9-46bc-a28e-3c3e71fc20de.png" width="300"/>
</p>

The Admin can simply select Clubs and users from the respective tables, and it will allocate the teachers to the Clubs once the "Submit" button has been pressed. The allocation can then be seen on the table. The supervisor will now be able to access, on their homepage, a table that contains all of the students who have signed up to their Club that they are supervising.


### Management of Students’ Club Selections

Once the accounts for students have been created, it is possible for them to select Clubs. However, the Admin needs a way to manage all of the selections.

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208979035-145f310c-e4bd-4132-a0c4-fc16ab0cfd8f.png" width="800"/>
</p>

This is what the Admin will see to manage all of the students and their Club selections, and this is done by using `LEFT JOIN` SQL queries. It will display each of the students once if they have no Clubs selected but there is no limit to how many times they can appear on this list – although they will be limited to five because there are five days of school per week.

By using the drop down menus on the left-hand side, the Admin can select values that are linked to the database. 

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208979123-6ee43d74-c542-4a5b-bb45-d65f37acfd18.png" width="550"/>
</p>

Once the Admin presses the "Submit" button, the student is allocated a Club on the table, as seen in the table above. Additional Club allocations will show another row with the same student because they now have two Clubs they are signed up for. 


### PDF Printouts

A PDF document can be generated. It is possible to right click and print out a table that looks decent but that is extra clicks and requires extra effort. A simple button to generate a PDF document exists, and it makes use of jsPDF library and the jsPDF-AutoTable plugin.

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208979335-370886dd-4981-4728-bbe6-82286ecae1eb.png" width="700"/>
</p>

When a teacher logs in, they will all see a webpage similar to this. It will contain the Club they are supervising an also a table that contains all of the students who have selected that Club. 

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208979619-2cccc9c4-6bfe-4962-b16e-03db12831e6b.png" width="300"/>
</p>

From here, the supervisor simply presses the "Create PDF" button and a PDF file is generated and downloaded. A download prompt may appear depending on the browser configurations, or it will automatically download like in the screenshot above.

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208979782-0a144aa1-25c9-4756-a55d-2ae9e2ce4dc9.png" width="700"/>
</p>

The PDF file can be opened and will look like the one above. The values above the table will change depending on the Club.


### Posting and Viewing Messages

Another feature the supervisors and teachers have access is the ability to post messages for students to see. These students will need to have the Club that the teacher is supervising. The supervisor will have to navigate to the webpage to access the feature. 

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208979903-2da88e89-ea2e-46e9-9c93-e46dc69c175c.png" width="800"/>
</p>

The teachers can simply enter a message and it will be shown on the table on the right.

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208980027-a5c2fdfc-e3c6-42d8-ad24-41958d2cfa65.png" width="700"/>
</p>

Now that messages have been posted by the supervisor, the students are able to see it on their homepages. The homepage with messages can be seen in the screenshot above. The supervisor is still able to delete the messages whenever they want by pressing the Delete button.

<p align="center">
  <img src="https://user-images.githubusercontent.com/80691974/208980272-245e694b-f1ab-41eb-ae7a-847e0a12b734.png" width="700"/>
</p>

The Admin can, of course, view and monitor these messages when needed.
