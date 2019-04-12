# Online-Organ-Donation
A DBMS project on Online Organ Donation and Management

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
    4.1 First noramal form
    4.2 second noramal form
    4.3 third noramal form
   
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
    6.2 Snapshot Of Application
        6.2.1 Homepage
        6.2.2 Donor View
        6.2.3 Recipient View
        6.2.4 Doctor’s View
        6.2.5 Manager View
        
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
  * Server: localhost We are going to perform the project on windows platform so we need the OS as windows.Any version of windows as windows xp or above. The system should have minimum ram of 1 GB as well as minimum storage capacity of 15GB.The system should contain the server software named as Wampp of version 3.1.4.1VC11. And MySQL of version 5.7.23 or above.First we have to install both software and we have to do connectivity between them by changing the conﬁguration ﬁle of PHP ﬁle.

### SYSTEM DESIGN
#### ER Diagram-high level data modeling

!ER_Diag(https://github.com/adam-p/markdown-here/raw/master/src/common/images/icon48.png "Logo Title Text 1")

   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
