



In the last sprint I looked at, and incorporated, the HybridAuth and OAuth open source projects.HybridAuth is a PHP library used as an abstract api between a developer's web app and multiple soical apis including Facebook, Twitter and Google. OAuth is an ss0 that gives servers authenticated access to their assets without having to share single logon credit.

I chose to use HybridAuth because of the range of social apis it can access, aswell as its clean and easy to follow documentation. I used OAuth because it allowed me to configure a Client ID for my web app. In addition, HybridAuth natively supports OAuth.

For this assignment I have produced a fully working web app which you sign into Google to access, and that displays the information Google provides to websites that you allow access to your account.

I ran into numerous obstacles while creating this app. Initially I had followed a tutorial video for implimenting something simillar on Youtube. Unfortunately, the tutorial was for a much older version of HybridAuth which was almost completely different than the current build. Because of this I initially had to revert to the older version. The older version required a Google Console API that was no longer supported, So I had to restart again using the latest version of HyrbidAuth and figure out what I needed to based on the provided documentation. In addition, I hosted the web app on my EC2 instance from my Web Dev 2830 class I am currently enrolled in. However, Google Developer's Console, which I used for the OAuth credentials, requires a static domain name. At the time of making the app I was unable to get a free domain name from feenom.com. I ended up having to purchase a '.com' to produce a working webapp. In order to link to domain to my EC2 instance I had to assign the instance an Elastic IP. When assigning the Type A resource record to the IPv4 of the Elastic IP, the domain name would take atleast an hour to update, causing me to break the link multiple times while trying to fix it.

In this sprint I looked into why certain features I have included did not work as itended. Specifically my address and birthday displays on the web app. I learned about the range of scopes in OAuth and how the birthday and address fields fall under restricted scopes that I will not be able to use without a review from Google.
