## Web Application and Demo (Project Part 3)

### Quick Start
1. Create a MySQL database with the restauarnt.ddl script in XAMMP
2. Run the backend locally
3. Run the frontend locally
4. Access the web application through your localhost

### Instructions
Restaurant Database Functional Requirements

You will write a fully functioning web-based interface for the restaurant database based on the database that we have been working on in class thus far.

When the functional requirements were developed, your clients realized that they should have stored the date on which the orders were placed.  Add this information to your database schema.

Your application should implement the following functionality.
- List all the orders made on a particular date.  The user should be asked for a  date and you will list the first and last name of the customer, the items ordered, the total amount of the order, the tip, and the name of the delivery person who delivered the order.
- Provide a way to add a new customer to the database.  You will need to ask for all the customer information.  You should check to ensure that the customer doesn't already exist in the database.  An account should be created for them with $5.00 credit.
- Create a table that shows dates on which orders were placed along with the number of orders on that date.
- Allow the user to choose an employee and show their schedule for Monday to Friday.  Do not show the schedule for Saturday or Sunday, even if the employee works on those days.

How you organize your application is up to you, but your application must have more than one web page -- not all functionality should be on the same page.  Your home page should be called restaurant.  This can be an html or a php page.   To use your application, we should NOT have to directly access any other URL other than the restaurant page.  (You may have links on the home page to other functionality which is acceptable). 

Information that would be well suited to a tabular display must be displayed as a table.  Proper html tags must be used for headings, paragraphs, lists etc.  Your application doesn't need to be flashy, but it needs to be visually appealing with at least one image.  Make it look as professional as you can.  I'm not asking for an expert web application, I'm just looking for some reasonable effort.
Your application must use PHP to generate the dynamic content (ie. accessing the back end database and displaying the results) and must be able to work with (almost) any DBMS (therefore you must be using PDOs, not the mysqli api).

These requirements are a minimum, you may add additional functionality.  You may find that you need to add additional data and or functionality to make your application realistic, or to demonstrate that it works.  You may assume that user input is correct so input syntax checking can be minimal.  You should gracefully handle the case(s) where your query does not return any results.

### Deliverables
1) zip all your code files and submit to ONQ.  Remember, your home page should be called "restaurant" (the extension will be html or php).   Include any images that you have used for your application.  We will unpack your code and run it on our own web servers.  Image references should use a path relative to the home page.   Your application should work "out of the box" without any modifications.
2) hand in the script that you use for creating your database and loading the data.  You may make changes to the table creations etc script from the last assignment if you wish.  However, your script should drop the restaurant database and create it as the first two lines of your script.  Your script should be in plain text so that we can easily import the script and build you database before running your application.  Failure to hand in your script will result in significantly reduced marks.
3) 5% of your mark will be based on a video demo of your project.  In a 3-5 minute video (videos longer than 5 minutes will receive reduced marks), show all the functionality that you were required to implement.  Your video should walk through the functionality and demonstrate that your program works.  Be sure to show us that if you add something to the database, it really has been added!    Videos should be uploaded to ONQ OR to Youtube (or any other hosting site) with a link provided in the comment section of the submission site.   If you upload to Youtube, you can make the video unlisted which means that only people who have the link will be able to view it.    If uploading to ONQ, your video must be submitted as an mp4.