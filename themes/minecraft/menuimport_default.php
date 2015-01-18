<?php

include("../../_setup.php");
include("../../classes/member.php");

$member = new Member($mysqli);
$consoleObj = new ConsoleOption($mysqli);

$websiteSettingsCID = $consoleObj->findConsoleIDByName("Website Settings");
$consoleObj->select($websiteSettingsCID);

if(!isset($_SESSION['btUsername']) || !isset($_SESSION['btPassword']) || !$member->select($_SESSION['btUsername']) || ($member->select($_SESSION['btUsername']) && !$member->authorizeLogin($_SESSION['btPassword'])) || ($member->select($_SESSION['btUsername']) && $member->authorizeLogin($_SESSION['btPassword']) && !$member->hasAccess($consoleObj))) {
	header("HTTP/1.0 404 Not Found");
	exit();
}


$menuSQL = "
INSERT INTO `menuitem_custompage` (`menucustompage_id`, `menuitem_id`, `custompage_id`, `prefix`, `linktarget`, `textalign`) VALUES(3, 19, 12, '<b>&middot;</b> ', '', 'left');
INSERT INTO `menuitem_custompage` (`menucustompage_id`, `menuitem_id`, `custompage_id`, `prefix`, `linktarget`, `textalign`) VALUES(2, 18, 11, '<b>&middot;</b> ', '', 'left');

INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(1, 1, 'index.php', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(3, 8, 'news', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(4, 9, 'members.php', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(5, 10, 'ranks.php', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(6, 11, 'squads', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(7, 12, 'tournaments', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(8, 13, 'events', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(9, 14, 'medals.php', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(10, 15, 'diplomacy', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(11, 16, 'diplomacy/request.php', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(12, 20, 'forum', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(13, 21, 'signup.php', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(29, 45, 'forgotpassword.php', '', '<b>&middot;</b> ', 'left');

INSERT INTO `menuitem_shoutbox` (`menushoutbox_id`, `menuitem_id`, `width`, `height`, `percentwidth`, `percentheight`, `textboxwidth`) VALUES(1, 2, 0, 0, 0, 0, 0);

INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(3, 0, 'Main Menu', 1, 'customcode', '<img src=''[MAIN_ROOT]themes/minecraft/images/layout/menu/mainmenu.png''>', 0, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(2, 0, 'Top Players', 2, 'customcode', '<img src=''[MAIN_ROOT]themes/minecraft/images/layout/menu/topplayers.png''>', 0, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(5, 0, 'Forum Activity', 4, 'customcode', '<img src=''[MAIN_ROOT]themes/minecraft/images/layout/menu/forumactivity.png''>', 0, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(1, 1, 'Shoutbox', 1, 'customcode', '<img src=''[MAIN_ROOT]themes/minecraft/images/layout/menu/shoutbox.png''>', 0, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(4, 1, 'Newest Members', 2, 'customcode', '<img src=''[MAIN_ROOT]themes/minecraft/images/layout/menu/newestmembers.png''>', 0, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(6, 2, 'Logged In', 1, 'custom', '', 1, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(7, 2, 'Logged Out', 2, 'custom', '', 2, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(8, 0, 'Poll', 3, 'customcode', '<img src=''[MAIN_ROOT]themes/minecraft/images/layout/menu/poll.png''>', 0, 1);

INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(2, 1, 'Shoutbox', 'shoutbox', 1, 0, 0, 1);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(3, 2, 'Top Players Links', 'top-players', 0, 0, 0, 1);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(1, 3, 'Home', 'link', 1, 0, 0, 1);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(8, 3, 'News', 'link', 3, 0, 0, 2);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(9, 3, 'Members', 'link', 4, 0, 0, 3);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(10, 3, 'Ranks', 'link', 5, 0, 0, 4);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(11, 3, 'Squads', 'link', 6, 0, 0, 5);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(12, 3, 'Tournaments', 'link', 7, 0, 0, 6);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(13, 3, 'Events', 'link', 8, 0, 0, 7);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(14, 3, 'Medals', 'link', 9, 0, 0, 8);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(15, 3, 'Diplomacy', 'link', 10, 0, 0, 9);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(16, 3, 'Diplomacy Request', 'link', 11, 0, 0, 10);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(19, 3, 'Rules', 'custompage', 3, 0, 0, 11);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(18, 3, 'History', 'custompage', 2, 0, 0, 12);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(20, 3, 'Forum', 'link', 12, 0, 0, 13);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(21, 3, 'Sign Up', 'link', 13, 2, 0, 14);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(45, 3, 'Forgot Password', 'link', 29, 2, 0, 15);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(4, 4, 'Newest Members', 'newestmembers', 0, 0, 0, 1);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(5, 5, 'Forum Activity', 'forumactivity', 0, 0, 0, 1);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(31, 6, 'Default Login', 'login', 0, 1, 0, 1);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(32, 7, 'Default Login', 'login', 0, 2, 0, 1);

";


$menuSQL = str_replace("INSERT INTO `", "INSERT INTO `".$dbprefix, $menuSQL);


$emptyMenusSQL = "TRUNCATE `".$dbprefix."menuitem_customblock`;";
$emptyMenusSQL .= "TRUNCATE `".$dbprefix."menuitem_custompage`;";
$emptyMenusSQL .= "TRUNCATE `".$dbprefix."menuitem_image`;";
$emptyMenusSQL .= "TRUNCATE `".$dbprefix."menuitem_link`;";
$emptyMenusSQL .= "TRUNCATE `".$dbprefix."menuitem_shoutbox`;";
$emptyMenusSQL .= "TRUNCATE `".$dbprefix."menu_category`;";
$emptyMenusSQL .= "TRUNCATE `".$dbprefix."menu_item`;";


$fullSQL = $emptyMenusSQL.$menuSQL;

if($mysqli->multi_query($fullSQL)) {


	do {
		if($result = $mysqli->store_result()) {
			$result->free();
		}
	}
	while($mysqli->next_result());
	
	echo "Menus restored to default!";
	
	
}

?>

