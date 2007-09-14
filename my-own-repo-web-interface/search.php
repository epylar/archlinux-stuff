<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<HTML>
<HEAD>
    <TITLE>Packages<TITLE>
    <META http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
</HEAD>
<BODY>
<TABLE border=1>
<TR><TH>Name<TH>Version<TH>Description<TH>Last updated</TR>
<?php
    $BASE_DB_DIR = "/tmp";
    $REPONAME = "myrepo";
    define(PDO_URL, "sqlite:".$BASE_DB_DIR."/".$REPONAME.".db");

    try
    {
	$dbHandle = new PDO(PDO_URL);
    }
    catch( PDOException $exception )
    {
	die($exception->getMessage());
    }

    foreach ($dbHandle->query('SELECT id, pkgname, pkgver, pkgdesc, url, builddate, packager, size, arch, license, depend, backup, filelist, lastupdated from packages ORDER BY pkgname') as $row)
    {
	$pkgid = $row[0];
	$pkgname = $row[1];
	$pkgver = $row[2];
	$pkgdesc = $row[3];
	$url = $row[4];
	$builddate = $row[5];
	$packager = $row[6];
	$size = $row[7];
	$arch = $row[8];
	$license = $row[9];
	$depend = $row[10];
	$backup = $row[11];
	$filelist = $row[12];
	$lastupdated = date("Y.m.d H.i.s", $row[13]);
	echo "<TR><TD><A HREF='detail.php?id=$pkgid'>$pkgname</A><TD>$pkgver<TD>$pkgdesc<TD>$lastupdated</TR>\n";
    }
?>
</TABLE>
</BODY>
</HTML>
