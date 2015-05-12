What is ACS Viewer?

The ACS Viewer Module replaces the default behavior of downloading a file when a file link is clicked within the SugarCRM Document module. Instead, the file selected is displayed within Accusoft’s ACS Viewer, and of course, the option to download your document is preserved.

Accusoft’s ACS Viewer is a document viewer that enables you to display dozens of different kinds of files on your website without worrying about whether your visitors have the software to view them and without installing any additional hardware or software. The document files stay on your server, so you can update, edit and change them anytime. ACS Viewer supports dozens of file types, including DOC, PDF, PPT, XLS and CAD. For additional information about Accusoft products please visit http://accusoft.com/

AcsViewer installs a new logic hook for all modules: custom/modules/Accusoft/AcsViewerLogicHook.php The hook is an “after_ui_footer” hook to add common javascript to all pages. No SugarCRM core files are changed.