<?php 
$txtDateFr		= isset($_POST['txtDateFr']) ?  $_POST['txtDateFr'] : '';
$txtDateTo 		= isset($_POST['txtDateTo']) ?  $_POST['txtDateTo'] : '';
$txtID			= isset($_POST['txtID']) ?  $_POST['txtID'] : '%';
$txtID2			= isset($_POST['txtID2']) ?  $_POST['txtID2'] : '%';
$txtUser		= isset($_POST['txtUser']) ?  $_POST['txtUser'] : '%';
$txtDiv			= isset($_POST['txtDiv']) ?  $_POST['txtDiv'] : '%';
$txtDept		= isset($_POST['txtDept']) ?  $_POST['txtDept'] : '%';
$txtDiv2		= isset($_POST['txtDiv2']) ?  $_POST['txtDiv2'] : 'N';
$txtDept2		= isset($_POST['txtDept2']) ?  $_POST['txtDept2'] : 'N';
$txtUnit		= isset($_POST['txtUnit']) ?  $_POST['txtUnit'] : 'N';
$txtPos			= isset($_POST['txtPos']) ?  $_POST['txtPos'] : 'N';
$txtDoc			= isset($_POST['txtDoc']) ?  $_POST['txtDoc'] : 'N';
$txtStatus		= isset($_POST['txtStatus']) ?  $_POST['txtStatus'] : '%';
$txtWeb			= isset($_POST['txtWeb']) ?  'Y' : 'N';
$txtMobile		= isset($_POST['txtMobile']) ?  'Y' : 'N';
$txtTitle		= isset($_POST['txtTitle']) ?  $_POST['txtTitle'] : '';
$txtApps		= isset($_POST['txtApps']) ?  $_POST['txtApps'] : '';
$txtDocid		= isset($_POST['txtDocid']) ?  $_POST['txtDocid'] : 'N';
$txtDocver		= isset($_POST['txtDocver']) ?  $_POST['txtDocver'] : 'N';
$txtDoctitle	= isset($_POST['txtDoctitle']) ?  $_POST['txtDoctitle'] : 'N';
$txtFile		= isset($_POST['txtFile']) ?  $_POST['txtFile'] : '%';
$txtDT			= isset($_POST['txtDT']) ?  $_POST['txtDT'] : '%';
$txtVer			= isset($_POST['txtVer']) ?  $_POST['txtVer'] : '%';
$txtPosition	= isset($_POST['txtPosition']) ?  $_POST['txtPosition'] : '%';


if(isset($_POST['btnDocument01'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Document&st=".$txtStatus."&id=".$txtID."'>";
}
if(isset($_POST['btnDocumentDate'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Document-Date&fr=".$txtDateFr."&to=".$txtDateTo."&di=".$txtDocid."&dv=".$txtDocver."&dt=".$txtDoctitle."&t=".$txtTitle." '>";
}
if(isset($_POST['btnDocumentDateSubmit'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Document-Date-Pdf&fr=".$txtDateFr."&to=".$txtDateTo."&di=".$txtDocid."&dv=".$txtDocver."&dt=".$txtDoctitle."&t=".$txtTitle." '>";
}
if(isset($_POST['btnDocumentCategory'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Document-Category&fr=".$txtDateFr."&to=".$txtDateTo."&id=".$txtID."&di=".$txtDocid."&dv=".$txtDocver."&dt=".$txtDoctitle."&t=".$txtTitle." '>";
}
if(isset($_POST['btnDocumentCategorySubmit'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Document-Category-Pdf&fr=".$txtDateFr."&to=".$txtDateTo."&id=".$txtID."&di=".$txtDocid."&dv=".$txtDocver."&dt=".$txtDoctitle."&t=".$txtTitle." '>";
}
if(isset($_POST['btnDocumentDoc'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Document-Doc&fr=".$txtDateFr."&to=".$txtDateTo."&id=".$txtID."&di=".$txtDocid."&dv=".$txtDocver."&dt=".$txtDoctitle."&t=".$txtTitle." '>";
}
if(isset($_POST['btnDocumentDocSubmit'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Document-Doc-Pdf&fr=".$txtDateFr."&to=".$txtDateTo."&id=".$txtID."&di=".$txtDocid."&dv=".$txtDocver."&dt=".$txtDoctitle."&t=".$txtTitle." '>";
}
if(isset($_POST['btnDocumentUser'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Document-User&fr=".$txtDateFr."&to=".$txtDateTo."&id=".$txtID."&di=".$txtDocid."&dv=".$txtDocver."&dt=".$txtDoctitle."&t=".$txtTitle." '>";
}
if(isset($_POST['btnDocumentUserSubmit'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Document-User-Pdf&fr=".$txtDateFr."&to=".$txtDateTo."&id=".$txtID."&di=".$txtDocid."&dv=".$txtDocver."&dt=".$txtDoctitle."&t=".$txtTitle." '>";
}
if(isset($_POST['btnDocumentDiv'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Document-Div&fr=".$txtDateFr."&to=".$txtDateTo."&id=".$txtID."&id2=".$txtID2."&di=".$txtDocid."&dv=".$txtDocver."&dt=".$txtDoctitle."&t=".$txtTitle." '>";
}
if(isset($_POST['btnDocumentDivSubmit'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Document-Div-Pdf&fr=".$txtDateFr."&to=".$txtDateTo."&id=".$txtID."&id2=".$txtID2."&di=".$txtDocid."&dv=".$txtDocver."&dt=".$txtDoctitle."&t=".$txtTitle." '>";
}
if(isset($_POST['btnDocumentDetail'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Document-Detail&id=".$txtID."&v=".$txtVer."&f=".$txtFile."&d=".$txtDateFr."&dt=".$txtDT."&div=".$txtDiv2."&dept=".$txtDept2."&unit=".$txtUnit."&pos=".$txtPos."&t=".$txtTitle."'>";
}
if(isset($_POST['btnDocumentDetailSubmit'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Document-Detail-Pdf&id=".$txtID."&v=".$txtVer."&f=".$txtFile."&d=".$txtDateFr."&dt=".$txtDT."&div=".$txtDiv2."&dept=".$txtDept2."&unit=".$txtUnit."&pos=".$txtPos."&t=".$txtTitle."'>";
}

if(isset($_POST['btnUserDate'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-User-Date&fr=".$txtDateFr."&to=".$txtDateTo."&w=".$txtWeb."&m=".$txtMobile."&t=".$txtTitle."'>";
}
if(isset($_POST['btnUserDateSubmit'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-User-Date-Pdf&fr=".$txtDateFr."&to=".$txtDateTo."&w=".$txtWeb."&m=".$txtMobile."&t=".$txtTitle."'>";
}
if(isset($_POST['btnUserDetail'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-User-Detail&d=".$txtDateFr."&a=".$txtApps."&div=".$txtDiv2."&dept=".$txtDept2."&unit=".$txtUnit."&pos=".$txtPos."&t=".$txtTitle."'>";
}
if(isset($_POST['btnUserDetailSubmit'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-User-Detail-Pdf&d=".$txtDateFr."&a=".$txtApps."&div=".$txtDiv2."&dept=".$txtDept2."&unit=".$txtUnit."&pos=".$txtPos."&t=".$txtTitle."'>";
}

if(isset($_POST['btnUserDivision'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-User-Division&fr=".$txtDateFr."&to=".$txtDateTo."&id=".$txtID."'>";
}
if(isset($_POST['btnUserUser'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-User-User&fr=".$txtDateFr."&to=".$txtDateTo."&id=".$txtID."&w=".$txtWeb."&m=".$txtMobile."&t=".$txtTitle."'>";
}
if(isset($_POST['btnUserAll'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-User-All-Pdf&t=".$txtTitle."'>";
}
if(isset($_POST['btnUserUserSubmit'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-User-User-Pdf&fr=".$txtDateFr."&to=".$txtDateTo."&id=".$txtID."&w=".$txtWeb."&m=".$txtMobile."&t=".$txtTitle."'>";
}
if(isset($_POST['btnDocument'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Document&fr=".$txtDateFr."&to=".$txtDateTo."&user=".$txtUser."&div=".$txtDiv."&dept=".$txtDept."&doc=".$txtDoc."&pos=".$txtPosition."&di=".$txtDocid."&dv=".$txtDocver."&dt=".$txtDoctitle."&div2=".$txtDiv2."&dept2=".$txtDept2."&unit=".$txtUnit."&pos2=".$txtPos."&t=".$txtTitle."'>";
}
if(isset($_POST['btnDocumentSubmit'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Document-Pdf&fr=".$txtDateFr."&to=".$txtDateTo."&user=".$txtUser."&div=".$txtDiv."&dept=".$txtDept."&doc=".$txtDoc."&pos=".$txtPosition."&di=".$txtDocid."&dv=".$txtDocver."&dt=".$txtDoctitle."&div2=".$txtDiv2."&dept2=".$txtDept2."&unit=".$txtUnit."&pos2=".$txtPos."&t=".$txtTitle."'>";
}
if(isset($_POST['btnDoc'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Doc&id=".$txtID."'>";
}
if(isset($_POST['btnDiv'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Report-Div&id=".$txtID."&t=".$txtTitle."'>";
}
if(isset($_POST['btnDocumentTBF'])){	
	echo "<meta http-equiv='refresh' content='0; url=?page=Document-TBF&st=".$txtStatus."&id=".$txtID."'>";
}

if (isset($_POST['btnDashboardFilter'])) {
	echo "<meta http-equiv='refresh' content='0; url=?page=Dashboard&fr=" . $txtDateFr . "&to=" . $txtDateTo . "'>";
}
