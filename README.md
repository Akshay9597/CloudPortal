CLOUD PORTAL

Aim:
The aim of our project is to give the end users, the students, a platform for easy sharing of data throughout the campus. As there are a lot of unused PCs in the Computer Department which have a lot of computation power and storage space getting wasted we can use them and create a distributed storage system.

Cloud Portal is a Distributed Files System which emulates a cloud environment. This works on 3 parts, the user end web-app, the server and the nodes. 
Using the web-app, the user can upload/delete/download files as required.  There are additional functionalities as making a file public/private so that the user can make files available to everyone.
The demographic of our platform is college students as data sharing is absolutely necessary in today's world. Data in the form of books, assignments, papers, movies, music is shared a lot among college students.

These are the functionalities:

Upload a file
Delete a file
Search a file
Private/Public a file

Backend:
Adding a node
Removing a node


Installation and Working:

passdb.php -> mysql username, password

On the main server run the file fileSender.py and on the nodes run fileReciever.py before uploading any files.

Flow of the project: index.html/signup.html --> checklogin.php/signup.php --->uploadform.php ---> upload.php ---->showfiles.php/searchfile.php/logout.php/delete.php

