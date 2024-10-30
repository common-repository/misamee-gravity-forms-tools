=== Misamee Gravity Forms Tools ===  
Contributors: sciamannikoo, cmwwebfx  
Donate link: http://misamee.com/donate/  
Tags: gravity forms, formula, grandtotal, gravity-forms, shortcode, formula, expression, calculation, progressbar, progress-bar  
Requires at least: 3.3  
Tested up to: 3.4  
Stable tag: 1.3.1  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html  

Add a shortcode that sums data frm Gravity Forms entries, showing the result as a value, percentage or progressbar.

== Description ==

**If you're upgrading from a version prior to <1.3, please checkout the changelog**

Misamee Gravity Forms Tools adds some additional features to Gravity Forms.

**`[mgft-grandtotal]`**
Shows a sum, based on form's entries. This sum can be based on a single field or a formula.

**`[mgft-progressbar]`**
Shows a progress bar, based on form's entries. Current value and max value can be calculated based on a single field or a formula.

* [More details](http://misamee.com/2012/10/misamee-gravity-forms-tools/)  
* [Live demo](http://misamee.com/2012/10/misamee-gravity-forms-tools-live-examples/)

== Installation ==

= Easy way =

Add the plugin from your WordPress site and activate, or...  

= Geek way =

1. Download `misamee-gf-tools.zip`
2. Decompress `misamee-gf-tools.zip` in a directory called `misamee-gf-tools`
3. Upload the directory to the `/wp-content/plugins/` directory
4. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently asked questions ==

http://misamee.com/2012/10/misamee-gravity-forms-tools/

== Screenshots ==

1. You'll get a new button in the WordPress post editor (this applies to post, pages, etc.).
2. The shortcode wizard provides you with all available settings.
3. If you need help finding the right placeholder for a field, providing that you've already selected the source form, just click on **[?] List fields**.  
This shows a popup window (you can keep it open while working with the wizard) with a list of all fields you can use and some additional data for multi value fields.  
* **Placeholder**: column is the actual string you should type in your expression.  
* **Field Name**: is the actual name of the field.  
* **Type**: give you an hint of what kind of field is. Remember to always use fields that returns numerical values, or the final result will be undetermined. "text" fields may works as long as they contains numbers.  
* **Possible values**: this shows which possible values can be stored for this field (only where the field as "choices", like in multivalues fields like select boxes, checkboxes groups, etc).  
Values are shown in **bold**. Enclosed in parenthesis you will see the text value (if different from the value).  
4. Providing that you’ve filled the minimum required settings, you’ll get the shortcode and a preview in real time (clicking on “Create the shortcode” will add the shortcode to the editor, of course).

== Changelog ==

= 1.3.1 =  
* Added some more styling to the wizard editor  
* More code refactoring  
* New screenshots  

= 1.3 =  
* Some refactoring  
* Added shortcode wizard in WordPress editor (future release will also integrate a field selection helper)  
* **IMPORTANT** Changed shortcode argument "status" to "entrystatus" to solve some DOM conflicts with the shortcode wizard   and to make this argument's name less generic  
* Progress bar: when using "autostyle = true", the javascript is not included anymore, as unneeded  

= 1.2.5 =  
* Added the ability to filter entries by starred status and/or a free text  
* Added the ability to show formatted numbers (locale aware)  

= 1.2.4 =  
* Updated the readme.txt  

= 1.2.3 =  
* Updated Author URI  

= 1.2.2 =  
* Updated readme.txt  

= 1.2.1 =  
* Added customizable colors in the progress bar  
* Progress bar value is now shown (default), but can be optionally hidden  

= 1.2 =  
* Added the progressbar shortcode  

= 1.1 =  
* Added expression argument, removed old arguments, improved shortcode and argument names  

= 1.0 =  
* Initial release  

== Upgrade Notice ==

= 1.3.1 =  
This update doesn't provide any additional feature, only some makeup, and improved quality code.

= 1.3 =  
Added the shortcode wizard. **Please read the changelog!!!**  

= 1.2.5 =  
This update adds some filtering options and number formatting  

= 1.2.4 =  
Not mandatory  

= 1.2.3 =  
Not mandatory  

= 1.2.2 =  
Not mandatory  

= 1.2.1 =  
Upgrade if you want to add customizable colors to the progress bar and display the percentage  

= 1.2 =  
Upgrade if you want to add a progress bar based on your sums  

= 1.1 =  
This upgrade make the shortcode more usable  

= 1.0 =  
Initial release  