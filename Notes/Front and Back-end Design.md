# Front and Back-end Design

There are two parts to discuss about the design of this project because there were two parts to this website, although the focus of this project was on the back-end aspect.

## Front-End Design

The front-end of the website considers the design of the website itself – how it looks and feels. The website is written in HTML but the files end with `.php` due to the files using PHP to make changes to the website. PHP allows the usage of echo to print out HTML and the final webpage will look like an ordinary HTML webpage.

When designing the website, it was also important to consider the design in other forms rather than just how it would look on a computer that is 1080p or 4K. Mobile phones and tablets make use of lower resolutions such as 480p or 720p, both of which will provide less horizontal space to work with and can often run resolutions lower than 480p. To achieve this, the website is made to be responsive – changing how it looks at the two different resolutions – and dynamic.

The website was also always made with the idea that information would be pulled from the database and displayed to the user, and this is known as a dynamic website. PHP allows us to access data that is stored on the server (database) and display them depending on who has logged in. The login page is essentially a static webpage because it will be identical to all users to allow them to log into the website. Once the user has logged in, they will see a homepage that will be displaying different bits of information that is tailored for them. For example, the Teachers will have a different homepage when compared to Students.

The colour scheme is set to be similar across all of the webpages to keep the website looking minimalistic and have a clean design.

## Navigation Bar

Each of the webpages do not contain any lines that could refer to a navigation bar, and instead, a PHP script is entered in which accesses another file (header.php) that is used to echo markup language that HTML can use. Essentially, to include a navigation bar, all I have to do is call the file [header.php](../header.php) and it will contain all of the necessary lines of code depending on what kind of user has logged in. This saves me the time and effort of having to manually create navigation bars for each of the webpages. This is my own method of replicating something like a framework  which could save me a lot of time had I used one.

In [header.php](../header.php), we can see that there are multiple echo commands which are all different things depending on who is currently logged in. It uses their typeID to correctly show the right hyperlinks to parts of the website they can use. A switch case is used here, and the default behaviour is to forward users to the login page because the header will detect that they have not logged in.

## Back-End Design

The back-end aspect of this project was the database, and it was made using MySQL. PHP was being used to make the website and it allowed for good compatibility between the two technologies.

At the start of the project, a few weeks were spent to design the database through an Entity Relationship Diagram, also known as ERD. This ERD took some time to develop due me making changes constantly throughout the weeks and to allow for a normalised database. There were additional features that were added in later, and this was due to me coming up with ideas that would make the website better and were not considered in the original ERD model itself.

The database being used is MySQL and I selected this due to it being free and also with me having some experience with it.

## Implementation

When it came to creating the website, I did not want to use frameworks as I knew they would make things a bit easier but came with the disadvantage that I would not fully understand what each function was doing. I wanted to make certain features of the website myself and understand how different lines of code were going to behave if they were done differently.

