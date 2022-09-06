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
		case 'Dashboard':
			if (!file_exists("dashboard.php")) die("Sorry Empty Page!");
			include "dashboard.php";
			break;
		case 'Dashboard-Print':
			if (!file_exists("dashboard_print.php")) die("Sorry Empty Page!");
			include "dashboard_print.php";
			break;
		case 'Dashboard-Detail':
			if (!file_exists("dashboard_detail.php")) die("Sorry Empty Page!");
			include "dashboard_detail.php";
			break;
		case 'Dashboard-Detail-Print':
			if (!file_exists("dashboard_detail_print.php")) die("Sorry Empty Page!");
			include "dashboard_detail_print.php";
			break;
		case 'Dashboard-Table':
			if (!file_exists("dashboard_table.php")) die("Sorry Empty Page!");
			include "dashboard_table.php";
			break;
		case 'Filter':
			if (!file_exists("filter.php")) die("Sorry Empty Page!");
			include "filter.php";
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

			# MASTER ==================================================================

			# MASTER TODOLIST
		case 'Todolist':
			if (!file_exists("todolist.php")) die("Sorry Empty Page!");
			include "todolist.php";
			break;

			# MASTER LOGO
		case 'Logo':
			if (!file_exists("logo.php")) die("Sorry Empty Page!");
			include "logo.php";
			break;

			# MASTER BANNER
		case 'Banner':
			if (!file_exists("banner.php")) die("Sorry Empty Page!");
			include "banner.php";
			break;
		case 'Banner-Delete':
			if (!file_exists("banner_delete.php")) die("Sorry Empty Page!");
			include "banner_delete.php";
			break;

			# MASTER WALLPAPER
		case 'Wallpaper':
			if (!file_exists("wallpaper.php")) die("Sorry Empty Page!");
			include "wallpaper.php";
			break;

			# MASTER STATUS
		case 'Status':
			if (!file_exists("status.php")) die("Sorry Empty Page!");
			include "status.php";
			break;
		case 'Status-Add':
			if (!file_exists("status_add.php")) die("Sorry Empty Page!");
			include "status_add.php";
			break;
		case 'Status-Delete':
			if (!file_exists("status_delete.php")) die("Sorry Empty Page!");
			include "status_delete.php";
			break;
		case 'Status-Edit':
			if (!file_exists("status_edit.php")) die("Sorry Empty Page!");
			include "status_edit.php";
			break;

			# MASTER CODE
		case 'Code':
			if (!file_exists("code.php")) die("Sorry Empty Page!");
			include "code.php";
			break;
		case 'Code-Add':
			if (!file_exists("code_add.php")) die("Sorry Empty Page!");
			include "code_add.php";
			break;
		case 'Code-Delete':
			if (!file_exists("code_delete.php")) die("Sorry Empty Page!");
			include "code_delete.php";
			break;
		case 'Code-Edit':
			if (!file_exists("code_edit.php")) die("Sorry Empty Page!");
			include "code_edit.php";
			break;


			# MASTER COMPANY
		case 'Company':
			if (!file_exists("company.php")) die("Sorry Empty Page!");
			include "company.php";
			break;
		case 'Company-Add':
			if (!file_exists("company_add.php")) die("Sorry Empty Page!");
			include "company_add.php";
			break;
		case 'Company-Delete':
			if (!file_exists("company_delete.php")) die("Sorry Empty Page!");
			include "company_delete.php";
			break;
		case 'Company-Edit':
			if (!file_exists("company_edit.php")) die("Sorry Empty Page!");
			include "company_edit.php";
			break;

			# MASTER ORGANIZATION
		case 'Organization':
			if (!file_exists("organization.php")) die("Sorry Empty Page!");
			include "organization.php";
			break;
		case 'Organization-Add':
			if (!file_exists("organization_add.php")) die("Sorry Empty Page!");
			include "organization_add.php";
			break;
		case 'Organization-Delete':
			if (!file_exists("organization_delete.php")) die("Sorry Empty Page!");
			include "organization_delete.php";
			break;
		case 'Organization-Edit':
			if (!file_exists("organization_edit.php")) die("Sorry Empty Page!");
			include "organization_edit.php";
			break;


			# MASTER COMPANY
		case 'Position':
			if (!file_exists("position.php")) die("Sorry Empty Page!");
			include "position.php";
			break;
		case 'Position-Add':
			if (!file_exists("position_add.php")) die("Sorry Empty Page!");
			include "position_add.php";
			break;
		case 'Position-Delete':
			if (!file_exists("position_delete.php")) die("Sorry Empty Page!");
			include "position_delete.php";
			break;
		case 'Position-Edit':
			if (!file_exists("position_edit.php")) die("Sorry Empty Page!");
			include "position_edit.php";
			break;

			# MASTER DOCUMENT
		case 'Document':
			if (!file_exists("document.php")) die("Sorry Empty Page!");
			include "document.php";
			break;
		case 'Document-Add':
			if (!file_exists("document_add.php")) die("Sorry Empty Page!");
			include "document_add.php";
			break;
		case 'Document-Delete':
			if (!file_exists("document_delete.php")) die("Sorry Empty Page!");
			include "document_delete.php";
			break;
		case 'Document-Edit':
			if (!file_exists("document_edit.php")) die("Sorry Empty Page!");
			include "document_edit.php";
			break;
		case 'Document-Files':
			if (!file_exists("document_files.php")) die("Sorry Empty Page!");
			include "document_files.php";
			break;
		case 'Document-Files-Delete':
			if (!file_exists("document_files_delete.php")) die("Sorry Empty Page!");
			include "document_files_delete.php";
			break;
		case 'Document-Files-Order':
			if (!file_exists("document_files_order.php")) die("Sorry Empty Page!");
			include "document_files_order.php";
			break;
		case 'Document-Files-Index-Delete':
			if (!file_exists("document_files_index_delete.php")) die("Sorry Empty Page!");
			include "document_files_index_delete.php";
			break;
		case 'Document-View':
			if (!file_exists("document_view.php")) die("Sorry Empty Page!");
			include "document_view.php";
			break;
		case 'Document-View-Archive':
			if (!file_exists("document_view_archive.php")) die("Sorry Empty Page!");
			include "document_view_archive.php";
			break;
		case 'Document-Version':
			if (!file_exists("document_version.php")) die("Sorry Empty Page!");
			include "document_version.php";
			break;
		case 'Document-Status':
			if (!file_exists("document_status.php")) die("Sorry Empty Page!");
			include "document_status.php";
			break;
		case 'Document-Approval':
			if (!file_exists("document_approval.php")) die("Sorry Empty Page!");
			include "document_approval.php";
			break;
		case 'Document-Approval-Add':
			if (!file_exists("document_approval_add.php")) die("Sorry Empty Page!");
			include "document_approval_add.php";
			break;
		case 'Document-Approval-Delete':
			if (!file_exists("document_approval_delete.php")) die("Sorry Empty Page!");
			include "document_approval_delete.php";
			break;
		case 'Document-Expiration':
			if (!file_exists("document_expiration.php")) die("Sorry Empty Page!");
			include "document_expiration.php";
			break;
		case 'Document-Expiration-Edit':
			if (!file_exists("document_expiration_edit.php")) die("Sorry Empty Page!");
			include "document_expiration_edit.php";
			break;
		case 'Document-Privileges':
			if (!file_exists("document_privileges.php")) die("Sorry Empty Page!");
			include "document_privileges.php";
			break;
		case 'Document-Files-Privileges':
			if (!file_exists("document_files_privileges.php")) die("Sorry Empty Page!");
			include "document_files_privileges.php";
			break;
		case 'Document-Privileges-Edit':
			if (!file_exists("document_privileges_edit.php")) die("Sorry Empty Page!");
			include "document_privileges_edit.php";
			break;
		case 'Document-Privileges-Delete':
			if (!file_exists("document_privileges_delete.php")) die("Sorry Empty Page!");
			include "document_privileges_delete.php";
			break;
		case 'Document-Files-Privileges-Delete':
			if (!file_exists("document_files_privileges_delete.php")) die("Sorry Empty Page!");
			include "document_files_privileges_delete.php";
			break;
		case 'Document-Search':
			if (!file_exists("document_search.php")) die("Sorry Empty Page!");
			include "document_search.php";
			break;
		case 'Document-Viewer':
			if (!file_exists("document_viewer.php")) die("Sorry Empty Page!");
			include "document_viewer.php";
			break;
		case 'Document-Review':
			if (!file_exists("document_review.php")) die("Sorry Empty Page!");
			include "document_review.php";
			break;
		case 'Document-Revised':
			if (!file_exists("document_revised.php")) die("Sorry Empty Page!");
			include "document_revised.php";
			break;
		case 'Document-Link':
			if (!file_exists("document_link.php")) die("Sorry Empty Page!");
			include "document_link.php";
			break;
		case 'Document-Link-Add':
			if (!file_exists("document_link_add.php")) die("Sorry Empty Page!");
			include "document_link_add.php";
			break;
		case 'Document-Link-Edit':
			if (!file_exists("document_link_edit.php")) die("Sorry Empty Page!");
			include "document_link_edit.php";
			break;
		case 'Document-Link-Delete':
			if (!file_exists("document_link_delete.php")) die("Sorry Empty Page!");
			include "document_link_delete.php";
			break;
		case 'Document-TBF':
			if (!file_exists("document_tbf.php")) die("Sorry Empty Page!");
			include "document_tbf.php";
			break;


			# MASTER Category
		case 'Category':
			if (!file_exists("category.php")) die("Sorry Empty Page!");
			include "category.php";
			break;
		case 'Category-Add':
			if (!file_exists("category_add.php")) die("Sorry Empty Page!");
			include "category_add.php";
			break;
		case 'Category-Delete':
			if (!file_exists("category_delete.php")) die("Sorry Empty Page!");
			include "category_delete.php";
			break;
		case 'Category-Edit':
			if (!file_exists("category_edit.php")) die("Sorry Empty Page!");
			include "category_edit.php";
			break;
		case 'Category-Import':
			if (!file_exists("category_import.php")) die("Sorry Empty Page!");
			include "category_import.php";
			break;
		case 'Category-Restore':
			if (!file_exists("category_restore.php")) die("Sorry Empty Page!");
			include "category_restore.php";
			break;

			# REPORT
		case 'Report-Document':
			if (!file_exists("report_document.php")) die("Sorry Empty Page!");
			include "report_document.php";
			break;
		case 'Report-Document-Pdf':
			if (!file_exists("report_document_pdf.php")) die("Sorry Empty Page!");
			include "report_document_pdf.php";
			break;
		case 'Report-Document-Date':
			if (!file_exists("report_document_date.php")) die("Sorry Empty Page!");
			include "report_document_date.php";
			break;
		case 'Report-Document-Date-Pdf':
			if (!file_exists("report_document_date_pdf.php")) die("Sorry Empty Page!");
			include "report_document_date_pdf.php";
			break;
		case 'Report-Document-User':
			if (!file_exists("report_document_user.php")) die("Sorry Empty Page!");
			include "report_document_user.php";
			break;
		case 'Report-Document-User-Pdf':
			if (!file_exists("report_document_user_pdf.php")) die("Sorry Empty Page!");
			include "report_document_user_pdf.php";
			break;
		case 'Report-Document-Category':
			if (!file_exists("report_document_category.php")) die("Sorry Empty Page!");
			include "report_document_category.php";
			break;
		case 'Report-Document-Category-Pdf':
			if (!file_exists("report_document_category_pdf.php")) die("Sorry Empty Page!");
			include "report_document_category_pdf.php";
			break;
		case 'Report-Document-Doc':
			if (!file_exists("report_document_doc.php")) die("Sorry Empty Page!");
			include "report_document_doc.php";
			break;
		case 'Report-Document-Doc-Pdf':
			if (!file_exists("report_document_doc_pdf.php")) die("Sorry Empty Page!");
			include "report_document_doc_pdf.php";
			break;
		case 'Report-Document-Div':
			if (!file_exists("report_document_div.php")) die("Sorry Empty Page!");
			include "report_document_div.php";
			break;
		case 'Report-Document-Div-Pdf':
			if (!file_exists("report_document_div_pdf.php")) die("Sorry Empty Page!");
			include "report_document_div_pdf.php";
			break;
		case 'Report-Document-Detail':
			if (!file_exists("report_document_detail.php")) die("Sorry Empty Page!");
			include "report_document_detail.php";
			break;
		case 'Report-Document-Detail-Pdf':
			if (!file_exists("report_document_detail_pdf.php")) die("Sorry Empty Page!");
			include "report_document_detail_pdf.php";
			break;
		case 'Report-User-Date':
			if (!file_exists("report_user_date.php")) die("Sorry Empty Page!");
			include "report_user_date.php";
			break;
		case 'Report-User-Date-Pdf':
			if (!file_exists("report_user_date_pdf.php")) die("Sorry Empty Page!");
			include "report_user_date_pdf.php";
			break;
		case 'Report-User-User':
			if (!file_exists("report_user_user.php")) die("Sorry Empty Page!");
			include "report_user_user.php";
			break;
		case 'Report-User-User-Pdf':
			if (!file_exists("report_user_user_pdf.php")) die("Sorry Empty Page!");
			include "report_user_user_pdf.php";
			break;
		case 'Report-User-Division':
			if (!file_exists("report_user_division.php")) die("Sorry Empty Page!");
			include "report_user_division.php";
			break;
		case 'Report-User-Detail':
			if (!file_exists("report_user_detail.php")) die("Sorry Empty Page!");
			include "report_user_detail.php";
			break;
		case 'Report-User-All':
			if (!file_exists("report_user_all.php")) die("Sorry Empty Page!");
			include "report_user_all.php";
			break;
		case 'Report-User-All-Detail':
			if (!file_exists("report_user_all_detail.php")) die("Sorry Empty Page!");
			include "report_user_all_detail.php";
			break;
		case 'Report-User-All-Pdf':
			if (!file_exists("report_user_all_pdf.php")) die("Sorry Empty Page!");
			include "report_user_all_pdf.php";
			break;
		case 'Report-User-Detail-Pdf':
			if (!file_exists("report_user_detail_pdf.php")) die("Sorry Empty Page!");
			include "report_user_detail_pdf.php";
			break;
		case 'Report-Doc':
			if (!file_exists("report_doc.php")) die("Sorry Empty Page!");
			include "report_doc.php";
			break;
		case 'Report-Doc-Pdf':
			if (!file_exists("report_doc_pdf.php")) die("Sorry Empty Page!");
			include "report_doc_pdf.php";
			break;
		case 'Report-Div':
			if (!file_exists("report_div.php")) die("Sorry Empty Page!");
			include "report_div.php";
			break;
		case 'Report-Div-Pdf':
			if (!file_exists("report_div_pdf.php")) die("Sorry Empty Page!");
			include "report_div_pdf.php";
			break;


		default:
			if (isset($_SESSION['SES_ADMIN'])) {
				if (!file_exists("main.php")) die("Sorry Empty Page!");
				include "main.php";
				break;
			}
			if (isset($_SESSION['SES_USER'])) {
				if (!file_exists("main_user.php")) die("Sorry Empty Page!");
				include "main_user.php";
				break;
			}
			break;
	}
} else {
	// Jika tidak mendapatkan variabel URL : ?page
	if (!file_exists("login.php")) die("Empty Main Page! Under Development");
	include "login.php";
}
