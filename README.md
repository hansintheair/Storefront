# Storefront

## Initial Setup
1. Clone repository to "<path>/XAMPP/htdocs"  
    cd into the directory with `cd "<path>/XAMPP/htdocs"` *NOTE: REPLACE <path> with your path!   
    `git clone https://github.com/hansintheair/Storefront.git`  
    You should have "<path>/XAMPP/htdocs/Storefront" when done cloning.
2. Open Netbeans
3. Click "New Project... (Ctrl+Shift+N)"
4. On the New Project Wizard -> Choose Project page
  5. Under Categories select "PHP"
  6. Under Projects select "PHP Application with Existing Sources"
  7. Click Next
8. On the New Project Wizard -> Name and Location page
  9. Browse to "htdocs/Storefront/storefront"
  10. Confirm project name is "storefront"
  11. Confirm PHP Version is "PHP 7.4"
  12. Click Next
13. On the New Project Wizard -> Run Configuration page
  14. Confirm Run As is set to "Local Web Site (running on local web server)
  15. Confirm Project URL is set to "http://localhost/Storefront/storefront/"
  16. Index File is set to "Home.php"
  17. Click Finish
18. Open MySQL Workbench
19. Select your localhost db to connect to it
20. On the left sidebar, under the "Administration" tab, select "Data Import/Restore"
21. On the localhost Data Import page, select the "Import from Self-Contained File" radio button and set the file path to "<path>/XAMPP/htdocs/BatteshipWeb/battleship/database/Battleships.sql"
22. Click Start Import
23. Complete the steps in the Run section to test that everything is set up correct

## Run
1. Start XAMPP Apache server
2. In Netbeans, right-click the Home.php file and select "run"  
    The start page to the Storefront project should open on your browser.  
    You should NOT see a 404 error.
