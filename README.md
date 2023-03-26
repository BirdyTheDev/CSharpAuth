# CSharpAuth:
C# Auth With MySQL Using HDD Serial.

# Photos:
![image](https://user-images.githubusercontent.com/128981901/227798908-a2bdc4ad-8203-4776-9033-724d5a9ca0b1.png)

# Setup:
Extract WebFiles To Xampp-->HtDocs-->Change MySql Connection Strings:
--------------------------------------------------
$servername = "localhost"; --> For LocalHost.

$username = "root"; --> Optionel.

$password = ""; --> Leave Empty If Use LocalHost.

$dbname = "gtlauncher"; --> Put DataBase Name Here.
---------------------------------------------------
Change Currentver.html In HtDocs If You Update Loader.
After That Please Dont Forget To Create Table Inside Your Database. Here How You Can Do It:
CREATE TABLE users (
  id VARCHAR(50) NOT NULL,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL
);
Paste This Code To Sql Execute Tab.
![image](https://user-images.githubusercontent.com/128981901/227799455-a2c53aba-3359-4ec9-8685-70d3d15edf79.png)


