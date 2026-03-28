# ServiceCo Website (Continued)

This is the source code for the **ServiceCo Website**, a PHP-based project.  
The project runs on **Mac** using **XAMPP** as the local server and is managed with **GitHub Desktop**.

## Prerequisites

Before setting up the project, ensure you have the following installed:
### Apps:
- [XAMPP for Mac](https://sourceforge.net/projects/xampp/files/XAMPP%20Mac%20OS%20X/8.2.4/xampp-osx-8.2.4-0-installer.dmg/download)
- [GitHub Desktop](https://desktop.github.com/download/)
- [VS Code](https://code.visualstudio.com/download)

Once these installers are downloaded, open the `Downloads` folder and open the installer, follow the steps inside the installer to install the apps

## Installation & Setup

### 1. Clone the Repository

1. Open **GitHub Desktop** and log in with your github account.
2. Click **File > Clone Repository**.
3. Select **URL** and enter:

   ```
   https://github.com/NISTTech/ServiceCo-Website
   ```

4. Choose a local folder (e.g., `~/Documents/GitHub/ServiceCo-Website`).
5. Click **Clone**.

### 2. Set Up XAMPP

1. Open **XAMPP** from your launch pad (Inside launchpad it is called `manager-osx`)and start:
   - **Apache** (for PHP & web server)
   - **MySQL** (for database)
2. Move the cloned project to the XAMPP `htdocs` folder (This is using terminal alternatively you can just open the `/Applications/XAMPP/xamppfiles/htdocs` folder and simply drag and drop the cloned folder inside `htdocs`):

   ```sh
   mv ~/Documents/GitHub/ServiceCo-Website /Applications/XAMPP/xamppfiles/htdocs
   ```

3. Open the project in a browser:

   ```
   http://localhost/ServiceCo-Website/
   ```

### 3. Configure the Database

1. Open **phpMyAdmin**:  
   - Visit: `http://localhost/phpmyadmin/`
   - Click **New Database** and name it `serviceco`.
2. Import the database:
   - Click **Import**.
   - Select `serviceco.sql` from the project folder.
   - Click **Go**.

### 4. Running the Project

1. Ensure **Apache** and **MySQL** are running in XAMPP.
2. Open a browser and visit:

   ```
   http://localhost/ServiceCo-Website/
   ```

## Development Workflow

### Pull Latest Changes

1. Open **GitHub Desktop**.
2. Click **Fetch Origin** to get the latest updates.
3. If updates are available, click **Pull**.

### Push Changes

1. After making changes, open **GitHub Desktop**.
2. Write a commit message describing the update.
3. Click **Commit to main**.
4. Click **Push Origin** to upload changes.

## Troubleshooting

- **Port 80 in use?**  
  Change Apache’s port in `httpd.conf` (e.g., `Listen 8080`).
- **Changes not showing?**  
  Clear browser cache or restart Apache. (Or you can just use incognito mode and see if that works.)

## Contributors

- [uqnquvwfkq](https://github.com/uqnquvwfkq)
- [hviegelahn-collab](https://github.com/hviegelahn-collab)
- [joon0987](https://github.com/joon0987)
- [Jiyeon118](https://github.com/Jiyeon118)
- [codexplor](https://github.com/codexplor)

---

