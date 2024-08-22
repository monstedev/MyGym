# MyGym

## :exclamation: Introduction
MyGym is a very simple program created for those who train at home and want to create their own personalized training plan. <br />
The program does not contain a system for accessing and creating an account, so you need to download and start it on your device.
> This first version contains only the basic functions for everyday use, the program will be updated in the future with the implementation of new pages and new functions.

To start and use it you need to follow the steps listed below

## :gear: Steps to start MyGym
> This procedure takes for granted that phpmyadmin, Visual Studio Code and xampp are installed.
1. Download the .zip file from GitHub and extract everything in the htdocs folder of xampp
2. Open phpmyadmin in the browser and go to the SQL page, where you will have to insert the SQL script present in the database.sql file, this will create your personal database
3. Now you have to connect the database to the code: go to the config/constants.php file and modify the various entries as explained directly in the file
4. Finished, now you can start the program and create your personalized training schedules and start them!
> You may be wondering... why these steps instead of a published site with an account system?
> Very simple, the idea was of an open source software open to changes and suggestions, therefore you can modify the code and database as you wish.

## :books: Guide to the website
> The site initially contains 2 pages, the home and the dashboard:
> - Our training schedules are displayed on the home
> - In the dashboard you can create, edit and delete schedules <br />

> Here are some images of the site:

 - Creation of a training schedule:
<img src="https://cdn.discordapp.com/attachments/905081533717692426/1276099872801427506/Screenshot_2024-08-22_104347.png?ex=66c84c1e&is=66c6fa9e&hm=7023e409917c568bf210ee39a34473dc212e17b76d052d608640672c689f11f2&" >

 - Dashboard
> Each schedule has its own panel where you can add, remove and modify exercises
<img src="https://media.discordapp.net/attachments/905081533717692426/1276099873359527947/Screenshot_2024-08-22_104422.png?ex=66c84c1e&is=66c6fa9e&hm=b8dbe34fd153a777a3dda525ab2e2176781b83dece0c087350fc3b30414a5150&=&format=webp&quality=lossless&width=1191&height=670" >

- Home
> Your schedules are displayed here, with the option to see the list of exercises and start the card.
<img src="https://media.discordapp.net/attachments/905081533717692426/1276099873778700310/Screenshot_2024-08-22_104441.png?ex=66c84c1e&is=66c6fa9e&hm=a2e038d97a8f46e8f864a104ddca1be47f7b8405bf979152416440345d574051&=&format=webp&quality=lossless&width=1191&height=670" >

- Start
> This is the page that opens when you start a schedule, initially there are 10 seconds of preparation. At any time you can pause and restart the training. Each exercise after the work time has its relative recovery time.
<img src="https://media.discordapp.net/attachments/905081533717692426/1276099874240331826/Screenshot_2024-08-22_104450.png?ex=66c84c1e&is=66c6fa9e&hm=65fb2da299b8f6b857eccd5bc33080e721fce6b772aed95fa7250484a1681016&=&format=webp&quality=lossless&width=1191&height=670" >
