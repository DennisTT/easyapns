#!/usr/bin/php
<?PHP
#################################################################################
## Developed by Manifest Interactive, LLC				      ##
## http://www.manifestinteractive.com					  ##
## ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ##
##									     ##
## THIS SOFTWARE IS PROVIDED BY MANIFEST INTERACTIVE 'AS IS' AND ANY	   ##
## EXPRESSED OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE	 ##
## IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR	  ##
## PURPOSE ARE DISCLAIMED.  IN NO EVENT SHALL MANIFEST INTERACTIVE BE	  ##
## LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR	 ##
## CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF	##
## SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR	     ##
## BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,       ##
## WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE	##
## OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,	   ##
## EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.			  ##
## ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ ##
## Author of file: Peter Schmalfeldt					   ##
#################################################################################

/**
 * @category Apple Push Notification Service using PHP & MySQL
 * @package EasyAPNs
 * @author Peter Schmalfeldt <manifestinteractive@gmail.com>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link http://code.google.com/p/easyapns/
 *
 * This is a sample of how multiple apps can be used with the same EasyAPNS setup
 */

/**
 * Begin Document
 */

// AUTOLOAD CLASS OBJECTS... YOU CAN USE INCLUDES IF YOU PREFER
if(!function_exists("__autoload")){ 
	function __autoload($class_name){
		require_once('classes/class_'.$class_name.'.php');
	}
}

// CREATE DATABASE OBJECT ( MAKE SURE TO CHANGE LOGIN INFO )
$db = new DbConnect('localhost', 'apnsuser', 'apnspassword', 'apnsdb');
$db->show_errors();

// FETCH $_GET OR CRON ARGUMENTS TO AUTOMATE TASKS
$args = (!empty($_GET)) ? $_GET:array('task'=>$argv[1]);

// SET UP DIFFERENT APP IDS SUPPORTED AND THEIR CERTIFICATES
$appIds = array(
	'com.yourcompany.app1' => array(
		'certificate' => '/usr/local/apns/aps_app1_production.pem',
		'sandboxCertificate' => '/usr/local/apns/aps_app1_development.pem',
		'logPath' => '/usr/local/apns/apns_app1.log'),
	'com.yourcompany.app2' => array(
		'certificate' => '/usr/local/apns/aps_app2_production.pem',
		'sandboxCertificate' => '/usr/local/apns/aps_app2_development.pem',
		'logPath' => '/usr/local/apns/apns_app2.log'));

// CREATE APNS OBJECT, WITH DATABASE OBJECT AND ARGUMENTS
if(in_array($args['clientid'], array_keys($appIds)))
	$apns = new APNS($db, $args['clientid'], $args, $appIds[$args['clientid']]['certificate'], $appIds[$args['clientid']]['sandboxCertificate'], $appIds[$args['clientid']]['logPath']);
?>
