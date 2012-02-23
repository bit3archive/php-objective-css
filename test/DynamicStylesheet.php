<?php

/**
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 */

// http://piratenpad.de/p/i_need_a_complex_css_file

/**
 * @copyright  InfinitySoft 2010,2011
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    ObjectiveLessCss
 * @license    LGPL
 * @filesource
 */
// include basic classes
include('../src/ObjectiveLessCss/CssException.php');
include('../src/ObjectiveLessCss/ArraySet.php');
include('../src/ObjectiveLessCss/RuleSet.php');
include('../src/ObjectiveLessCss/Rule.php');
include('../src/ObjectiveLessCss/Block.php');
include('../src/ObjectiveLessCss/SelectorSet.php');
include('../src/ObjectiveLessCss/Selector.php');
include('../src/ObjectiveLessCss/Style.php');

// include rule classes
include('../src/ObjectiveLessCss/Comment.php');
include('../src/ObjectiveLessCss/Import.php');
include('../src/ObjectiveLessCss/Charset.php');
include('../src/ObjectiveLessCss/FontFace.php');

// include block classes
include('../src/ObjectiveLessCss/Stylesheet.php');
include('../src/ObjectiveLessCss/Media.php');
include('../src/ObjectiveLessCss/Styles.php');

$stylesheet = new \ObjectiveLessCss\Stylesheet();
$stylesheet->addRule(new \ObjectiveLessCss\Charset('UTF-8'));

$media = new \ObjectiveLessCss\Media('all');

$body = new \ObjectiveLessCss\Styles();
$body->addSelector(new \ObjectiveLessCss\Selector('body'));
$body->addSelector(new \ObjectiveLessCss\Selector('table'));
$body->addRule(new \ObjectiveLessCss\Style('font-family', 'Verdana'));

$wildcard = new \ObjectiveLessCss\Styles();
$wildcard->addSelector(new \ObjectiveLessCss\Selector('*'));
$wildcard->addRule(new \ObjectiveLessCss\Style('line-height', '100.01%'));

$fontface = new \ObjectiveLessCss\FontFace();

$body->addRule($wildcard);
$media->addRule($body);
$stylesheet->addRule(new \ObjectiveLessCss\Comment('I am a dynamic stylesheet.

I was generated with the ObjectiveLessCss API and can be outputed as css or less css code.'));
$stylesheet->addRule($fontface);
$stylesheet->addRule($media);

echo "--- CSS ---\n";
echo $stylesheet->toCss();
echo "\n";
echo "--- Less CSS ---\n";
echo $stylesheet->toLessCss();
