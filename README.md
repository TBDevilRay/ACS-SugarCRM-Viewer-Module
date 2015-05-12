# ACS-SugarCRM-Viewer-Module
The ACS Viewer Module replaces the default behavior of downloading a file when a file link is clicked within the SugarCRM Document module. Instead, the file selected is displayed within Accusoft’s ACS Viewer, and of course, the option to download your document is preserved.

Accusoft’s ACS Viewer is a document viewer that enables you to display dozens of different kinds of files on your website without worrying about whether your visitors have the software to view them and without installing any additional hardware or software. The document files stay on your server, so you can update, edit and change them anytime. ACS Viewer supports dozens of file types, including DOC, PDF, PPT, XLS and CAD. For additional information about Accusoft products please visit http://accusoft.com/

AcsViewer installs a new logic hook for all modules:
custom/modules/Accusoft/AcsViewerLogicHook.php
The hook is an “after_ui_footer” hook to add common javascript to all pages.
No SugarCRM core files are changed.

# Table of Contents
* [Acquiring an ACS API Key](#api-key)
* [Adding the ACS API Key to the Viewer Module](#add-key)
* [Installing the AcsViewer Module](#install)

# <a name="api-key"></a>Acquiring an ACS API Key
  1. Create an account at https://cloudportal.accusoft.com/
  2. Select, “My Keys” from the menu
  3. Copy and save the key shown in a secure location.

# <a name="add-key"></a>Adding the ACS API Key to the Viewer Module
  1. Navigate to where the AcsViewer.zip file is stored on your computer.
  2. Locate the file acsApiKey.php within AcsViewer.zip and edit it.
  3. Replace the string, {generated_api_access_key} with the api key you received from Accusoft.

      define("ACS_API_KEY", “{generated_api_access_key}”);

  4. Save and place acsApiKey.php back into AcsViewer.zip at the same location, which is the root or base path.

# <a name="install"></a>Installing the AcsViewer Module
  1. Login to SugarCRM
  2. Go to the Admin Menu and select Module Loader from the Developer Tools section
  3. Click on, “Choose File” and navigate to where the AcsViewer.zip file is stored.
  4. Click the Upload button and once uploaded click the Install button.
  5. Click the Commit button.
  6. You’re done!
