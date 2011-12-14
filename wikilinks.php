<?php
// Wiki Markup Link Parser
// Author: Jonathan Lee
// Website: http://www.compmath.com/blog/projects/wiki-markup-link-parser/
// Last updated: December 13, 2011
$output = "";

$source = $_REQUEST['source'];
if (!empty($source)) {
        $output = "";
        if (preg_match_all("/\*['\s]{1,2}?\[\[(.+?)\]\]/", $source, $matches,PREG_PATTERN_ORDER)) {
                for ($i=0; $i<count($matches[1]); $i++) {
                        $title = $matches[1][$i];
                        //take only proper name if delimited by | (pipe)
                        if (strpos($title,"|")>0) $title = substr(strstr($title,"|"),1);

                        //take out anything in parenthesis
                        if (strpos($title,"(")>0) $title = substr($title,0,strpos($title,"("));

                        $output .= "$title\n";
                }
        } else {
                $output = "not found";
        }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Wiki Markup Link Parser</title>
</head>

<body>
<h1>Wiki Markup Link Parser</h1>
This script takes <a href="http://en.wikipedia.org/wiki/Help:Wiki_markup">Wiki markup</a> (the source used on Wikipedia and other Mediawiki sites) and extracts the name of all internal links in a list. Any disambiguation is removed as well.<br /><br />
Usage examples: <br />
* [[Baseball]] => "Baseball"<br />
*''[[Italics]] => "Italics"<br />
* [[R (programming language)]] => "R"<br />
* [[Probability density function|PDF]] => "PDF"<br /><br />
Regular expression used to match [[internal link]] list markup: <code>/\*['\s]{1,2}?\[\[(.+?)\]\]/</code><br />
<br />
Input:
<br />
<form action="wikilinks.php" method="post">
        <textarea name="source" style="width:500px;height:200px"><?= $source ?></textarea><br />
        <input type="submit" value="Parse!" />
</form>
<br />
Output:
<br />
<textarea style="width:500px;height:200px;"><?= $output ?></textarea>
<br />
<a href="http://www.compmath.com/blog/projects/wiki-markup-link-parser/">Back to project page</a>, Last updated: December 13, 2011 by Jonathan Lee.
</body>
</html>

