<h1 align="center">vaseis-app</h1>

vaseis-app web application providing information and visualization of the statistics of the Greek Panhellenic Entrance Exams. 

The web application can be accessed [here](https://vaseis.iee.ihu.gr)

vaseis-app API
---

This repository includes the API that was built in order to distribute the relevant data freely. More information about using the API can be found [here](https://vaseis.iee.ihu.gr/api)

API Features
---
* Universities endpoints which include the name of the universities and their logos.
* Departments endpoints which include the name, website, secretary phone and their emails.
* Bases endpoints which include the grades of the best and worst successful candidates, open positions of each department and more.
* Statistics endpoints which include the number of students who picked each department as one of their choices and more.
* Exam types and Special categories endpoints which include the different types and categories used historically by the Ministry of Education.

Development
---
The web application and API were built using vanilla JS and PHP, so they should fairly easy to setup. The PHP code was written having in mind that it would run at a server with PHP version 7 installed, but it should run on later versions as well without any issue.

The database used at the time of the development was mariaDB. The code uses the mysqli plugin instead of PDO, so it would be better using mariaDB/mySQL as this would require less refactoring of the codebase. In order to set up the database structure and fill it with the data see DATABASE.md(coming soon).

Libraries Used
---
* [Chart.js](https://www.chartjs.org/)
* [Prism](https://prismjs.com/)

Licence
---
[GNU General Public License v3.0](LICENSE)



