
### Namecheap.com Registrar Module for WHMCS 5/6/7

***

Currently, Namecheap provides two versions of the Namecheap.com WHMCS Registrar module:
- [Namecheap.com Registrar Module version 1.1.12 for WHMCS 4](https://github.com/namecheap/domains-whmcs4)
- [Namecheap.com Registrar Module version 1.2.11 for WHMCS 5/6/7](https://github.com/namecheap/domains-whmcs)

The instructions on how to install and use the [Namecheap.com Registrar Module version 1.2.11](https://github.com/namecheap/domains-whmcs) can be found below.

##### Description

The Namecheap.com WHMCS Registrar module is an open-source plugin that is distributed free of charge. It focuses on integrating Namecheap as a domain registrar at WHMCS.

After the integration, you can set up Namecheap as the default registrar for your customers and decide which services and TLDs to offer to your customers from within the WHMCS admin area.

##### Pre-requisites

- Access to WHMCS admin area.
- An understanding of Namecheap’s environments.
- Namecheap account with API access enabled on the desired environment. To enable API access, follow these [instructions](https://www.namecheap.com/support/api/intro.aspx). The API FAQ can be found [here](https://www.namecheap.com/support/knowledgebase/article.aspx/9739/63/api-faq).

##### Production and test environments
Namecheap has a production as well as a test server environment. 
The test server environment is called [Sandbox](http://www.sandbox.namecheap.com/). We urge you to test the WHMCS Registrar module in our Sandbox environment before switching to production. For more detailed information, please visit the developer's site at http://www.namecheap.com/support/api/api.aspx.

##### Download and installation
- Download the latest module (domains-whmcs-xxx.zip) compatible with your WHMCS version and extract files from the archive to your computer

- Find the folder called namecheap under Modules/Registrar in your WHMCS root directory (or create such a folder if it’s not there). Replace the downloaded namecheap.php, namecheapapi.php and additionaldomainfields.php files in the folder with existing files with the same naming

- WHMCS comes with the “includes/additionaldomainfields.php”file (more information can be found here), which has a basic configuration of additional fields for certain TLDs. If you are going to register IDN domains, .CA, .AU or .FR domains, it is needed to add an additional code that will connect our own file that already has the required fields. The following strings are to be added in the end of the “includes/additionaldomainfields.php” file in this case:

if (file_exists(dirname(FILE)."/../modules/registrars/namecheap/additionaldomainfields.php")) { include dirname(FILE)."/../modules/registrars/namecheap/additionaldomainfields.php"; }

NOTE: This action does not apply to a particular Registrar module but takes effect for the whole WHMCS system.

##### Configuration
To configure WHMCS for use with Namecheap, perform the following steps:
1. Log into your **WHMCS admin** panel

2. Click on the **Setup** menu, select **Products/Services** and click on **Domain Registrars**:
![Domain Registrars](http://files.namecheap.com/assets/img/github/domainregistrars.png "Domain Registrars")

3. Click on **Activate** next to Namecheap in the list:
![Activate](http://files.namecheap.com/assets/img/github/activate.png "Activate")

4. Enter your API credentials. If you wish to try out the module in Sandbox, enter your Sandbox username and Sandbox API key only into the corresponding fields and check the **“Test Mode”** box:
![Test Mode](http://files.namecheap.com/assets/img/github/testmode.png "Test Mode")

5. Optional settings:
- It’s recommended to enable DebugMode that allows saving logs of API calls. If this option is disabled, the module will be logging only errors returned by the module. API logs can be checked under Utilities > Logs > Module Log.

- If you have a promotional coupon code from Namecheap, you can enter it into the PromotionCode field. The discounted price will be automatically applied on your orders according to the coupon pricing.

6. Click Save Changes.

That’s it. The Namecheap module is now ready for use and will function just like any other built-in WHMCS registrar module.
You can now make Namecheap the automatic registrar, configure TLDs and services for all of your customers. To perform these actions, click on the Setup menu, select Products/Services and click on Domain Pricing in your WHMCS admin panel:
![Domain Pricing](http://files.namecheap.com/assets/img/github/domainpricing.png "Domain Pricing")

You can refer to [http://docs.whmcs.com/Domains_Configuration](http://docs.whmcs.com/Domains_Configuration) for more information.

##### Release notes - version 1.2.11
- Updated extended attributes for .ES, .COM.ES, .NOM.ES, .ORG.ES
- Added SGAdminId, COMSGAdminId parameters
- Removed Whoisguard restriction TLD list
- Added “Registeredfor” parameter for .UK domains in the SaveContactDetails method

##### Support
Please [submit a ticket](https://support.namecheap.com/index.php?/Tickets/Submit) to report bugs, provide feedback or receive assistance.




