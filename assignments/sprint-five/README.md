Chracter Creator Web App
Project by Nick Allegretti

Instructions to run Webapp-

1) Go to 'http://na4nnstudentprojects.com/na4nnCCS20/' (Note: No 'www.')
2) Sign into your Google Account.
3) Done.

Instructions to Host Webapp-

Note: This method requires a EC2 Instance and a dedicated domain.

1) Host an EC2 instance on Amazon Web Services.
2) Allocate an Elastic IP to your EC2 instance.
3) Set up a type A resource record on your dedicated domain pointing to your Elastic IP's IPv4. (I used Google Domains for this part.)
4) On Google APIs create a new OAuth Client ID credential.
5) Add your dedicated domain name to credential's Authorized redirect URIs.
Note: Must be a dedicated domain. Google will not accept an EC2 instance IP.
6) Download/Clone 'ssoServerFiles' for repository.
7) Open 'na4nnCCS20/config.php'.
8) Set the value of 'callback' replace YOURDOMAINHERE with your dedicated domain name.
Note: Leave '/na4nnCCS20/index.php' on the end of your domain name.
9) Replace 'YOURID' and 'YOURSECRET' with your Client ID and Client secret from your credential.
10) Save and close config.php, then move all the contents of ssoServerFiles to your EC2 instance.
11) Go to Your Domain/na4nnCCS20/ and sign into your Google Account.
12) Done

Note: To Logout of Google on either page click the 'Return to Projects' Button.
