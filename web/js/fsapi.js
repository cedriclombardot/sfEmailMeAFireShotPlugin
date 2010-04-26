 /* FireShotAPI
 **
 ** simple API for FireShot automation (capturing web pages using JavaScript).**
 ** Code licensed under Mozill Public License                                 **
 **     https://addons.mozilla.org/en-US/firefox/versions/license/69512       **
 **                                                                           **
 ** Author: Evgeny Suslikov, http://screenshot-program.com/fireshot           **
 **                                                                           */

var cFSEdit = 0;
var cFSSave = 1;
var cFSClipboard = 2;
var cFSEMail = 3;
var cFSExternal = 4;
var cFSUpload = 5;
var cFSPrint = 7;

var FireShotAPI =
{
	Key : "",  				// This key should be set up before using the API
	AutoInstall: true,      // Set this variable to false to switch off addon auto-installation
	
	// Check silently whether the addon is available at the client's PC, returns *true* if everything is OK. Otherwise returns *false*.
	isAvailable : function()
	{
		if (!this.isWindows() || !this.isFirefox()) return false;
		
		var element = document.createElement("FireShotDataElement");
		element.setAttribute("FSAvailable", false);
		document.documentElement.appendChild(element);

		var evt = document.createEvent("Events");
		evt.initEvent("checkFSAvailabilityEvt", true, false);

		element.dispatchEvent(evt);

		return element.getAttribute("FSAvailable") == "true";
	},
	
	// Installs plugin
	installPlugin : function()
	{
		if (!this.isWindows() || !this.isFirefox())
		{
			this.errorOnlyFirefoxAtWindows();
			return;	
		}
		else
		{
			var xpi = new Object();
   			xpi['FireShot'] = "http://screenshot-program.com/fireshot.xpi";
   			InstallTrigger.install(xpi, FireShotAPI.installationDone);	
		}
	},
	
	// Callback function seems to be not working properly
	installationDone : function(name, result)
	{
	   if (result != 0 && result != 999)
		 alert("The install didn't seem to work, you could maybe try " +
			   "a manual install instead.\nFailure code was " + result + ".");
	   else
		 alert("Installation complete, please restart your browser.");
	},

	// Capture web page and perform desired action
	capturePage : function(EntirePage, Action, Key)
	{
		if (this.AutoInstall && !this.isAvailable())
		{
			this.installPlugin();
			return;
		}
		
		var element = document.createElement("FireShotDataElement");
		element.setAttribute("Entire", EntirePage);
		element.setAttribute("Action", Action);
		element.setAttribute("Key", Key);
		document.documentElement.appendChild(element);

		var evt = document.createEvent("Events");
		evt.initEvent("capturePageEvt", true, false);

		element.dispatchEvent(evt);
	},

	// Capture web page (Entire = true for capturing the web page entirely) and *edit*
	editPage : function(Entire)
	{
		this.capturePage(Entire, cFSEdit, this.Key);
	},

	// Capture web page and *save to disk*
	savePage : function(Entire)
	{
		this.capturePage(Entire, cFSSave, this.Key);
	},
	
	// Capture web page and *copy to clipboard*
	copyPage : function(Entire)
	{
		this.capturePage(Entire, cFSClipboard, this.Key);
	},

	// Capture web page and *EMail*
	emailPage : function(Entire)
	{
		this.capturePage(Entire, cFSEMail, this.Key);
	},

	// Capture web page and *open it in a third-party editor*
	exportPage : function(Entire)
	{
		this.capturePage(Entire, cFSExternal, this.Key);
	},

	// Capture web page and *upload to free image hosting*
	uploadPage : function(Entire)
	{
		this.capturePage(Entire, cFSUpload, this.Key);
	},

	// Capture web page and *print*
	printPage : function(Entire)
	{
		this.capturePage(Entire, cFSPrint, this.Key);
	},

	// Check whether the addon is available and display the message if required
	checkAvailability : function()
	{
		// The plugin works only in Windows OS. We check it here.
		if (!this.isWindows() || !this.isFirefox())
		{
			this.errorOnlyFirefoxAtWindows();
			return;
		}
		
		if (!this.isAvailable() && confirm("FireShot plugin for Firefox not found. Would you like to install it?"))
			this.installPlugin();
	},
	
	// Check whether current OS is Windows
	isWindows : function()
	{
		return navigator.appVersion.indexOf("Win") != -1;	
	},
	
	// Check whether current browser is Firefox
	isFirefox : function()
	{
		return navigator.userAgent.indexOf("Firefox") != -1;
	},
	
	// Displays error message
	errorOnlyFirefoxAtWindows : function()
	{
		alert("Sorry, this plugin works only in Firefox under Windows OS.");	
	}
	
	
	
}