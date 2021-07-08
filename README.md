# Online-Organ-Donation
A DBMS project on Online Organ Donation Registration and Management

### Abstract

The Online Organ Donation Management System (OODMS) is developed mainly for general hospitals (GH), clinics and other health centers to manage the donor registration and user maintenance. It is an online system which only can be access or valid in Malacca state. The public can retrieve information about organ donation in this web site. People who interested can register themselves through this system. The application will be processed by the administrator and each donor will receive feedback about their application status. Furthermore, the authorized user’s account will be maintained by the administrator. The donor record will be managed by four main users such as administrator, doctor, medical assistant and management staﬀ. Only administrator has the authority and privileges to print organ list report and total donation report according to district from this system. The methodology of this system is Structured System Analysis and Design (SSADM). An analysis study has been done based on the current manual system and all the problems statements and requirements have been identiﬁed. Moreover, OODMS is three tier architecture system which involves client tier, business tier and database management tier. The interfaces for OODMS have been designed according to the requirement and needs of the current market Rather than that, this system also has been tested and evaluated in real life. This Online Organ Donation Management System will help to improve the performance of current situation and overcome the problems that arise nowadays.

### Acknowledgement

The following project was submitted to the Dept of Computer Science and Engineering of JSS Science and Technology University, Mysuru (JSSSTU).

First and foremost, we would like to thank our teacher, mentor and guide, Dr.Trisila Devi Nagavi.Without her assistance and guidance at every step, this project would have never been accomplished.

We would also like to show gratitude to our HOD, Dr.Vijayalakshmi H C, for always encouraging and motivating us to explore new arenas.She has been a constant pillar of support.

A special thanks goes to my team mates, Pooja Huggi and Pradeepkumar Kottalagi, who help to complete the project and gave important suggestion.I have to appreciate the guidance given by other supervisor as well as the panels especially in our project presentation that has improved our presentation skills thanks to their comment and advices.
Most importantly, we thank our parents and family, for providing constant help and support.



### Contents

##### 1. INTRODUCTION
    1.1 Overview 
    1.2 Background And Motivation
    1.3 Objective

##### 2. REQUIRMENTS
    2.1 Software Requirements
   
##### 3. SYSTEM DESIGN
    3.1 ER Diagram-high level data modeling
    3.2 Schema Diagram-Conceptual data modeling
   
##### 4. NORMALIZATION UP TO 3NF
    4.1 First Normal Form
    4.2 Second Normal Form
    4.3 Third Normal Form
   
##### 5. SYSTEM IMPLEMENTATION
    5.1 Introduction to MySQL
    5.2 Queries designed using SQL commands
        5.2.1 Alter
        5.2.2 Describe
        5.2.3 Insert
        5.2.4 Select
        5.2.5 Update
        5.2.6 Order By
        5.2.7 Group By
        5.2.8 Nested
        5.2.9 Delete

##### 6. GRAPHICAL USER INTERFACE
    6.1 Features Of Application
        6.1.1 Features
        6.1.2 Additional Features
        
##### 7. SYSTEM TESTING
    7.1 Project 
        7.1.1 Compilation Test
        7.1.2 Execution Test
        7.1.3 Output Test
        
##### 8. CONCLUSION
    8.1 Future Enhancement
    8.2 Technical Aspects
        8.2.1 Linux
        8.2.2 Php
        8.2.3 Apache
        8.2.4 Mysql
        
##### 9. REFERENCES

### INTRODUCTION
#### Overview
This report discusses the result of the work done in development of "Websites for Organ donation on "HTML" and "PHP" Front-end Platform and “My sql” as back-end Platform. At the development of an application PHP provides a good connecting facility between all pages, also the back-end My sql is most important to save all the data related the application.

#### Background And Motivation
The deﬁnition of our problem lies in manual system and a fully automated system.
  * MANUAL SYSTEM: The system is very time consuming and lazy. This system is more prone to Errors and sometimes the approaches to various problems are unstructured.
  * TECHNICAL SYSTEM: With the advent of latest technology if we do not update our system then our business results in losses gradually with time. The technical systems contains the tools of latestTrend i.e. computers printers, fax, Internet etc. The systems with this technology are very fast,Accurate, user-friendly and reliable.

#### Objective
Need of Organ Donation Websites:
  * To promote organ donation for transplantation as a treatment for many life threatening diseases including heart disease, kidney disease, liver disease, diabetes and cystic ﬁbrosis
  * To educate and inform the community, patients and their families and health professionals about organ and tissue donation to markedly improve rates of donation.
  * To work in partnership with Department of Health (DOH), clinicians, and hospitals to promote best practice professional training and ensure that the family of every potential donor is oﬀered the option of donation in a caring and respectful manner.
  * To provide support, care, information and advocacy for people and with end stage organ failure, donor families, living donors transplant recipients and their families.
  * To provide policy advice to DOH, clinicians and hospitals.
  * Assuring compliance with all external regulatory bodies, including but not limited to: the Organ Procurement and Transplantation Network (OPTN), the United Network for Organ Sharing (UNOS),Centers for Medicare and Medicaid Services (CMS) Conditions of Participation (COP), the Missouri State Department of Health (DOH), The Joint Commission (TJC) Standards
  * Ensuring the programs accreditation
  * Identifying opportunities for improvement
  * Prioritizing performance improvement and patient safety projects within organ transplantation
  * Continuously audit compliance and regulatory standards related to organ transplantation
  * Ensuring policies and procedures applicable to organ transplantation are evidence based, regularly reviewed and audited for compliance.
    
### REQUIRMENTS
#### Software Requirements
  * Operating System: Windows, Ubuntu
  * Back End : MySQL
  * Front End : HTML, CSS3 and PHP
  * Server: localhost We are going to perform the project on windows platform so we need the OS as windows.Any version of windows as windows xp or above. The system should have minimum ram of 1 GB as well as minimum storage capacity of 15GB.The system should contain the server software named as Wampp of version 3.1.4.1VC11. And MySQL of version 5.7.23 or above. First, we have to install both software and we have to do connectivity between them by changing the conﬁguration ﬁle of PHP ﬁle.

### SYSTEM DESIGN
#### ER Diagram-high level data modeling

![ER_Diag](https://github.com/rutwik-nayak/Online-Organ-Donation/blob/master/ER_diag.png "ER Diagram")

#### Schema Diagram-Conceptual data modeling

![Flow_Diag](https://github.com/rutwik-nayak/Online-Organ-Donation/blob/master/flow_diag.png "Flow Diagram")

### NORMALIZATION UP TO 3NF
#### First Normal Form:
A table is said to be in First Normal Form, if and only if each attribute of the relation is atomic.That is,each row in a table should be identiﬁed by primary key. No rows of data should have repeating group of column values. And we have achived 1NF by converting multi-valued attribute into separate entities like Address.

#### Second Noramal Form:
A relation is in Second Normal Form, if it is in 1NF and no non-prime attribute is dependent on any proper subset of any chandidate key of the relation. All the tables which are part of this project are in 2NF as they have atmost one primary key, so no partial dependency.

#### Third Noramal Form:
A Table is in third normal form,if and only if both of the following onditions holds:
  1. The relation table is in Second Normal form.
  2. Every non-primitive attribute of table is non-transitively dependent on every key if table.
And all the used tables satisfy both these conditions and hence are in 3NF.

### SYSTEM IMPLEMENTATION
#### Introduction to MySQL
  1. MySQL database -
     MySQL is a leading open source database management system. It is a multi-user, multithreaded database management system. MySQL is especially popular on the web. It is one of the parts of the very popular LAMP platform. Linux, Apache, MySQL and PHP. MySQL database is available on most important OS platforms. It runs on BSD Unix, Linux, Windows or Mac. Wikipedia, YouTube, Facebook use MySQL. These sites manage millions of queries each day. MySQL comes in two versions: MySQL server system and MySQL embedded system. The MySQL server software and the client libraries are dual-licensed: GPL version 2 and proprietary license.
     The development of MySQL began in 1994 by a Swedish company MySQL AB. Sun Microsystems acquired MySQL AB in 2008. Sun was bought by Oracle in 2010. MySQL, PostgreSQL, Firebird, SQLite, Derby, and HSQLDB are the most well known open source database systems.
        
  2. MariaDB -
     MariaDB is a community-developed fork of MySQL, intended to remain free under the GNU GPL. It is notable for being led by the original developers of MySQL, who forked it due to concerns over its acquisition by Oracle. MariaDB intends to maintain high compatibility with MySQL, ensuring a ”drop-in” replacement capability with library binary equivalency and exact matching with MySQL APIs and commands.
     A relational database is a collection of data organised in tables. There are relations among the tables. The tables are formally described. They consist of rows and columns. SQL (Structured Query Language) is a database computer language designed for managing data in relational database management systems. A table is a set of values that is organised using a model of vertical columns and horizontal rows. The columns are identiﬁed by their names. A schema of a database system is its structure described in a formal language. It deﬁnes the tables, the ﬁelds, relationships, views, indexes, procedures, functions, queues, triggers, and other elements.        
     A database row represents a single, implicitly structured data item in a table. It is also called a tuple or a record. A column is a set of data values of a particular simple type, one for each row of the table. The columns provide the structure according to which the rows are composed. A ﬁeld is a single item that exists at the intersection between one row and one column. A primary key uniquely identiﬁes each record in the table. A foreign key is a referential constraint between two tables. The foreign key identiﬁes a column or a set of columns in one (referencing) table that refers to a column or set of columns in another (referenced) table.
     A trigger is a procedural code that is automatically executed in response to certain events on a particular table in a database. A view is a speciﬁc look on data in from one or more tables. It can arrange data in some speciﬁc order, highlight or hide some data. A view consists of a stored query accessible as a virtual table composed of the result set of a query. Unlike ordinary tables a view does not form part of the physical schema. It is a dynamic, virtual table computed or collated from data in the database.A transaction is an atomic unit of database operations against the data in one or more databases. The eﬀects of all the SQL statements in a transaction can be either all committed to the database or all rolled back. An SQL result set is a set of rows from a database, returned by the SELECT statement. It also contains metainformation about the query such as the column names, and the types and sizes of each column as well. An index is a data structure that improves the speed of data retrieval operations on a database table.
        
#### Queries designed using SQL commands
##### Alter
*ALTER TABLE useraccount ADD CONSTRAINT userID PRIMARY KEY(userID);*
##### Describe
*DESCRIBE useraccount;*
##### Insert
*INSERT INTO useraccount(userName, passwrd, patientFlag, userID, active) VALUES ('rajeshkumar', 'password', 1, 'rajesh12345', 1);*
##### Select
*SELECT * FROM useraccount;
##### Update
*UPDATE useraccount SET passwrd = 'password123' where userName = 'rajeshkumar';*
##### Order By
*SELECT * FROM useraccount ORDER BY 1 ASC;*
##### Group By
*SELECT * FROM useraccount GROUP BY active;*
##### Nested
*SELECT * FROM useraccount where userName IN (SELECT userName FROM useraccount WHERE active = 0);*
##### Delete 
*DELETE FROM useraccount WHERE active = 0;*

### GRAPHICAL USER INTERFACE
The application is very user friendly and uses a GUI interface implemented in PHP and HTML to Communicate with the user. Various features are self – explanatory. Forms are easy to ﬁll in and components can be added, removed and updated very easily through a Single dialog box.
List boxes are used to display all the components at once so that user can see all the components of a Particular type at once. One can just select the component and modify and remove the component(based on the access control of the person).
#### Features Of Application
  1. Features
      * Clean separation of various components to facilitate easy modiﬁcation and revision.
      * All the data is maintained in a separate ﬁle to facilitate easy modiﬁcation
      * All the data required for diﬀerent operations is kept in a separate ﬁle.
      * Quick and easy saving and loading of database ﬁle
  2. Additional Features
      * Database optimized to reduce joins.
      * Constraints and validation of data managed in database as it is a DB project.
      * SQL injection into the application dealt with.
      * Minimal changes required in application for DB switch.
      * PHP PEAR database abstraction along with separate layer for DB connection implemented in Connection.php and DB.php
      * Only change required in DB change would be to change DB connection string in Connection.php
      * For a DB change, (sequence/anything equivalent to sequence) needs to be migrated for speciﬁc DB
      * implemented triggers
      * Views created for analyst reports.
    
### SYSTEM TESTING
#### Project Testing
  1. **Compilation Test** - It was a good idea to do our stress testing early on, because it gave us time to ﬁx some of the unexpected deadlocks and stability problems that only occurred when components were exposed to very high transaction volumes.
  2. **Execution Test** - This program was successfully loaded and executed. Because of good programming there were no execution errors.
  3. **Output Test** - The successful output screens are placed in the output screens section.

### CONCLUSION
Thus we have successfully implemented organ donation database management which helps us in centralizing the data used for managing the tasks performed in a organ donation we have succefully implemented various functionalities of mysql and php and created the fully functional database management system for organ donation.

#### Future Enhancement
It is not possible to develop a application that makes all the requirements of the user. User requirements keep on changing.so, Some of the future enhancements that can be done to this system are:
  * As the technology emerges, it is possible to upgrade the application and can be adaptable to desired environment.
  * We can also applicable this to Oracle and MySQL instead of SQL Server.
  * Based on the future security issues, security can be improved using encryption and decryption techniques.
  * We can also provide administrative tools like Backup, Replication and Linked Server.
#### Technical Aspects
The application was developed using the LAMP approach, i.e. Linux, Apache, MySQL and PHP.
  * Linux
  The project was developed in a Windows environment using Netbeans but is now hosted in Linux environment on the localhost servers. This was possible due to the high level of portability of php code.
  * PHP
  PHP is a widely-used general-purpose scripting language that is especially suited for Web development and can be embedded into HTML. All server side code was written in php. As mentioned the design was done in Windows in a WAMP environment and then the code was ported and hosted on Apache in Linux.
  * Apache
  The web server used is Apache with the php plugin. Apache again is a very reliable web server on both Windows and Linux and also maintains a very similar interface in both.
  * Mysql
  The database system used is MySQL which is an open source RDBMS. It is very light and highly functional. Also with PHP and MySQL being used together very frequently a lot of online support was available.

### REFERENCES
  * Allen. Jane E. “Man Has Unsafe Sex Just Before Donating Kidney, Gives HIV to the Recipient.” ABC News. 17 Mar. 2011. Web.
  Appel, Jacob M. “Wanted Dead or Alive? Kidney Transplantation in Inmates Awaiting Execution.” The Journal of Clinical Ethics 16.1 (2005): 58-60. Print.
  * Bernat, James L. et al. “The Circulatory-respiratory Determination of Death in Organ Donation.” Critical Care Medicine 38.3 (2010): 963-70. Web.
  * Gillman PhD. John. “Religious Perspectives on Organ Donation.” Critical Care Nursing Quarterly 22.3 (1999): 19-29. Web.
  * Grady, Denise, and Barry Meier. “A Transplant That Is Raising Many Questions.” The New York Times. 22 June 2009. Web.









   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
