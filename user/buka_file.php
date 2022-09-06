<?php


# KONTROL MENU PROGRAM
if ($_GET) {
	// Jika mendapatkan variabel URL ?page
	switch ($_GET['page']) {
		case '':
			if (!file_exists("login.php")) die("Empty Main Page!");
			include "login.php";
			break;
		case 'Main':
			if (!file_exists("main.php")) die("Sorry Empty Page!");
			include "main.php";
			break;
		case 'Login':
			if (!file_exists("login.php")) die("Sorry Empty Page!");
			include "login.php";
			break;
		case 'Login-Validasi':
			if (!file_exists("login_validasi.php")) die("Sorry Empty Page!");
			include "login_validasi.php";
			break;
		case 'Logout':
			if (!file_exists("login_out.php")) die("Sorry Empty Page!");
			include "login_out.php";
			break;
		case 'Login-Failed':
			if (!file_exists("login_failed.php")) die("Sorry Empty Page!");
			include "login_failed.php";
			break;
		case 'Help':
			if (!file_exists("help.php")) die("Sorry Empty Page!");
			include "help.php";
			break;
		case 'Setting':
			if (!file_exists("setting.php")) die("Sorry Empty Page!");
			include "setting.php";
			break;
		case 'Profile':
			if (!file_exists("profile.php")) die("Sorry Empty Page!");
			include "profile.php";
			break;
		case 'Test':
			if (!file_exists("test.php")) die("Sorry Empty Page!");
			include "test.php";
			break;
		case 'Favourite':
			if (!file_exists("favourite.php")) die("Sorry Empty Page!");
			include "favourite.php";
			break;
		case 'Dashboard':
			if (!file_exists("dashboard.php")) die("Sorry Empty Page!");
			include "dashboard.php";
			break;
		case 'Lang-ID':
			if (!file_exists("lang_id.php")) die("Sorry Empty Page!");
			include "lang_id.php";
			break;
		case 'Lang-EN':
			if (!file_exists("lang_en.php")) die("Sorry Empty Page!");
			include "lang_en.php";
			break;
		case 'Validasi':
			if (!file_exists("validasi.php")) die("Sorry Empty Page!");
			include "validasi.php";
			break;

			# USER LOGIN (Admin, User)
		case 'User':
			if (!file_exists("user.php")) die("Sorry Empty Page!");
			include "user.php";
			break;
		case 'User-Add':
			if (!file_exists("user_add.php")) die("Sorry Empty Page!");
			include "user_add.php";
			break;
		case 'User-Delete':
			if (!file_exists("user_delete.php")) die("Sorry Empty Page!");
			include "user_delete.php";
			break;
		case 'User-Edit':
			if (!file_exists("user_edit.php")) die("Sorry Empty Page!");
			include "user_edit.php";
			break;
		case 'User-Log':
			if (!file_exists("user_log.php")) die("Sorry Empty Page!");
			include "user_log.php";
			break;

			# HOME
		case 'Filter':
			if (!file_exists("filter.php")) die("Sorry Empty Page!");
			include "filter.php";
			break;
		case 'Search':
			if (!file_exists("search.php")) die("Sorry Empty Page!");
			include "search.php";
			break;

			# DOCUMENT
		case 'Document':
			if (!file_exists("document.php")) die("Sorry Empty Page!");
			include "document.php";
			break;
		case 'Document-List':
			if (!file_exists("document_list.php")) die("Sorry Empty Page!");
			include "document_list.php";
			break;
		case 'Document-Detail':
			if (!file_exists("document_detail.php")) die("Sorry Empty Page!");
			include "document_detail.php";
			break;
		case 'Document-Detail-PDF':
			if (!file_exists("document_detail_pdf.php")) die("Sorry Empty Page!");
			include "document_detail_pdf.php";
			break;
		case 'Document-Viewer':
			if (!file_exists("document_viewer.php")) die("Sorry Empty Page!");
			include "document_viewer.php";
			break;
		case 'Document-Open':
			if (!file_exists("document_open.php")) die("Sorry Empty Page!");
			include "document_open.php";
			break;

		case 'Document-Favourite':
			if (!file_exists("document_favourite.php")) die("Sorry Empty Page!");
			include "document_favourite.php";
			break;
		case 'Document-Favourite-Add':
			if (!file_exists("document_favourite_add.php")) die("Sorry Empty Page!");
			include "document_favourite_add.php";
			break;
		case 'Document-Favourite-Delete':
			if (!file_exists("document_favourite_delete.php")) die("Sorry Empty Page!");
			include "document_favourite_delete.php";
			break;
		case 'Document-Denied':
			if (!file_exists("document_denied.php")) die("Sorry Empty Page!");
			include "document_denied.php";
			break;
		case 'Document-Open-Denied':
			if (!file_exists("document_open_denied.php")) die("Sorry Empty Page!");
			include "document_open_denied.php";
			break;






		default:
			if (isset($_SESSION['SES_ADMIN'])) {
				if (!file_exists("main.php")) die("Sorry Empty Page!");
				include "main.php";
				break;
			}
			if (isset($_SESSION['SES_USER'])) {
				if (!file_exists("main.php")) die("Sorry Empty Page!");
				include "main.php";
				break;
			}
			break;
	}
} else {
	// Jika tidak mendapatkan variabel URL : ?page
	if (!file_exists("login.php")) die("Empty Main Page! Under Development");
	include "login.php";
}
