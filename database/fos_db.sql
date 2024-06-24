-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2023 at 10:55 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fos_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(30) NOT NULL,
  `client_ip` varchar(20) NOT NULL,
  `user_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`) VALUES
(7, 'Alkaine'),
(8, 'Purified'),
(9, 'Mineral');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `mobile` text NOT NULL,
  `email` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `city` text NOT NULL,
  `payment_method` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `img_path` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0= unavailable, 2 Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id`, `category_id`, `name`, `description`, `price`, `img_path`, `status`) VALUES
(8, 7, 'Refill Only ', 'Refill Only ', 35, '1686493980_refillOnly.png', 1),
(9, 7, 'Water Container 20L (with faucet)', 'Water Container 20L (with faucet)	', 200, '1686494040_WaterContainer20L.jpg', 1),
(10, 7, 'Water Container 20L (without faucet)', 'Water Container 20L (without faucet)', 210, '1686494040_waterContainer20LWithoutFaucet.jpg', 1),
(14, 8, 'Refill Only', 'Refill Only', 30, '1688131980_refillOnly.png', 1),
(15, 9, 'Refill Only', 'Refill Only', 25, '1688132040_refillOnly.png', 1),
(16, 9, 'Water Container 20L (without faucet)', 'Water Container 20L (without faucet)', 210, '1688132220_waterContainer20LWithoutFaucet.jpg', 1),
(17, 8, 'Water Container 20L (without faucet)', 'Water Container 20L (without faucet)', 210, '1688132220_waterContainer20LWithoutFaucet.jpg', 1),
(18, 9, 'Water Container 20L (with faucet)', 'Water Container 20L (with faucet)', 200, '1688132460_WaterContainer20L.jpg', 1),
(19, 8, 'Water Container 20L (with faucet)', 'Water Container 20L (with faucet)', 200, '1688132520_WaterContainer20L.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'MJB Water Refilling Station', 'admin@admin.com', '+639079373999', '1686991500_1686990660_water3.jpg', '&lt;!--[if gte mso 9]&gt;&lt;xml&gt; &lt;o:OfficeDocumentSettings&gt;  &lt;o:AllowPNG/&gt; &lt;/o:OfficeDocumentSettings&gt;&lt;/xml&gt;&lt;![endif]--&gt;&lt;!--[if gte mso 9]&gt;&lt;xml&gt; &lt;w:WordDocument&gt;  &lt;w:View&gt;Normal&lt;/w:View&gt;  &lt;w:Zoom&gt;0&lt;/w:Zoom&gt;  &lt;w:TrackMoves/&gt;  &lt;w:TrackFormatting/&gt;  &lt;w:PunctuationKerning/&gt;  &lt;w:ValidateAgainstSchemas/&gt;  &lt;w:SaveIfXMLInvalid&gt;false&lt;/w:SaveIfXMLInvalid&gt;  &lt;w:IgnoreMixedContent&gt;false&lt;/w:IgnoreMixedContent&gt;  &lt;w:AlwaysShowPlaceholderText&gt;false&lt;/w:AlwaysShowPlaceholderText&gt;  &lt;w:DoNotPromoteQF/&gt;  &lt;w:LidThemeOther&gt;EN-PH&lt;/w:LidThemeOther&gt;  &lt;w:LidThemeAsian&gt;X-NONE&lt;/w:LidThemeAsian&gt;  &lt;w:LidThemeComplexScript&gt;X-NONE&lt;/w:LidThemeComplexScript&gt;  &lt;w:Compatibility&gt;   &lt;w:BreakWrappedTables/&gt;   &lt;w:SnapToGridInCell/&gt;   &lt;w:WrapTextWithPunct/&gt;   &lt;w:UseAsianBreakRules/&gt;   &lt;w:DontGrowAutofit/&gt;   &lt;w:SplitPgBreakAndParaMark/&gt;   &lt;w:EnableOpenTypeKerning/&gt;   &lt;w:DontFlipMirrorIndents/&gt;   &lt;w:OverrideTableStyleHps/&gt;  &lt;/w:Compatibility&gt;  &lt;m:mathPr&gt;   &lt;m:mathFont m:val=&quot;Cambria Math&quot;/&gt;   &lt;m:brkBin m:val=&quot;before&quot;/&gt;   &lt;m:brkBinSub m:val=&quot;&amp;#45;-&quot;/&gt;   &lt;m:smallFrac m:val=&quot;off&quot;/&gt;   &lt;m:dispDef/&gt;   &lt;m:lMargin m:val=&quot;0&quot;/&gt;   &lt;m:rMargin m:val=&quot;0&quot;/&gt;   &lt;m:defJc m:val=&quot;centerGroup&quot;/&gt;   &lt;m:wrapIndent m:val=&quot;1440&quot;/&gt;   &lt;m:intLim m:val=&quot;subSup&quot;/&gt;   &lt;m:naryLim m:val=&quot;undOvr&quot;/&gt;  &lt;/m:mathPr&gt;&lt;/w:WordDocument&gt;&lt;/xml&gt;&lt;![endif]--&gt;&lt;!--[if gte mso 9]&gt;&lt;xml&gt; &lt;w:LatentStyles DefLockedState=&quot;false&quot; DefUnhideWhenUsed=&quot;false&quot;  DefSemiHidden=&quot;false&quot; DefQFormat=&quot;false&quot; DefPriority=&quot;99&quot;  LatentStyleCount=&quot;376&quot;&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;0&quot; QFormat=&quot;true&quot; Name=&quot;Normal&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; QFormat=&quot;true&quot; Name=&quot;heading 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; QFormat=&quot;true&quot; Name=&quot;heading 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; QFormat=&quot;true&quot; Name=&quot;heading 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; QFormat=&quot;true&quot; Name=&quot;heading 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; QFormat=&quot;true&quot; Name=&quot;heading 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; QFormat=&quot;true&quot; Name=&quot;heading 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; QFormat=&quot;true&quot; Name=&quot;heading 7&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; QFormat=&quot;true&quot; Name=&quot;heading 8&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;9&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; QFormat=&quot;true&quot; Name=&quot;heading 9&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;index 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;index 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;index 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;index 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;index 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;index 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;index 7&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;index 8&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;index 9&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; Name=&quot;toc 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; Name=&quot;toc 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; Name=&quot;toc 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; Name=&quot;toc 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; Name=&quot;toc 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; Name=&quot;toc 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; Name=&quot;toc 7&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; Name=&quot;toc 8&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; Name=&quot;toc 9&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Normal Indent&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;footnote text&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;annotation text&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;header&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;footer&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;index heading&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;35&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; QFormat=&quot;true&quot; Name=&quot;caption&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;table of figures&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;envelope address&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;envelope return&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;footnote reference&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;annotation reference&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;line number&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;page number&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;endnote reference&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;endnote text&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;table of authorities&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;macro&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;toa heading&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List Bullet&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List Number&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List Bullet 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List Bullet 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List Bullet 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List Bullet 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List Number 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List Number 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List Number 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List Number 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;10&quot; QFormat=&quot;true&quot; Name=&quot;Title&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Closing&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Signature&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;1&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; Name=&quot;Default Paragraph Font&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Body Text&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Body Text Indent&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List Continue&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List Continue 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List Continue 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List Continue 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;List Continue 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Message Header&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;11&quot; QFormat=&quot;true&quot; Name=&quot;Subtitle&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Salutation&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Date&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Body Text First Indent&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Body Text First Indent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Note Heading&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Body Text 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Body Text 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Body Text Indent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Body Text Indent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Block Text&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Hyperlink&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;FollowedHyperlink&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;22&quot; QFormat=&quot;true&quot; Name=&quot;Strong&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;20&quot; QFormat=&quot;true&quot; Name=&quot;Emphasis&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Document Map&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Plain Text&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;E-mail Signature&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;HTML Top of Form&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;HTML Bottom of Form&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Normal (Web)&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;HTML Acronym&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;HTML Address&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;HTML Cite&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;HTML Code&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;HTML Definition&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;HTML Keyboard&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;HTML Preformatted&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;HTML Sample&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;HTML Typewriter&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;HTML Variable&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Normal Table&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;annotation subject&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;No List&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Outline List 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Outline List 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Outline List 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Simple 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Simple 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Simple 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Classic 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Classic 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Classic 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Classic 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Colorful 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Colorful 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Colorful 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Columns 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Columns 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Columns 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Columns 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Columns 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Grid 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Grid 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Grid 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Grid 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Grid 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Grid 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Grid 7&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Grid 8&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table List 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table List 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table List 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table List 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table List 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table List 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table List 7&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table List 8&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table 3D effects 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table 3D effects 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table 3D effects 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Contemporary&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Elegant&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Professional&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Subtle 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Subtle 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Web 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Web 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Web 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Balloon Text&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; Name=&quot;Table Grid&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Table Theme&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; Name=&quot;Placeholder Text&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;1&quot; QFormat=&quot;true&quot; Name=&quot;No Spacing&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;60&quot; Name=&quot;Light Shading&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;61&quot; Name=&quot;Light List&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;62&quot; Name=&quot;Light Grid&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;63&quot; Name=&quot;Medium Shading 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;64&quot; Name=&quot;Medium Shading 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;65&quot; Name=&quot;Medium List 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;66&quot; Name=&quot;Medium List 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;67&quot; Name=&quot;Medium Grid 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;68&quot; Name=&quot;Medium Grid 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;69&quot; Name=&quot;Medium Grid 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;70&quot; Name=&quot;Dark List&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;71&quot; Name=&quot;Colorful Shading&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;72&quot; Name=&quot;Colorful List&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;73&quot; Name=&quot;Colorful Grid&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;60&quot; Name=&quot;Light Shading Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;61&quot; Name=&quot;Light List Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;62&quot; Name=&quot;Light Grid Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;63&quot; Name=&quot;Medium Shading 1 Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;64&quot; Name=&quot;Medium Shading 2 Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;65&quot; Name=&quot;Medium List 1 Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; Name=&quot;Revision&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;34&quot; QFormat=&quot;true&quot;   Name=&quot;List Paragraph&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;29&quot; QFormat=&quot;true&quot; Name=&quot;Quote&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;30&quot; QFormat=&quot;true&quot;   Name=&quot;Intense Quote&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;66&quot; Name=&quot;Medium List 2 Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;67&quot; Name=&quot;Medium Grid 1 Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;68&quot; Name=&quot;Medium Grid 2 Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;69&quot; Name=&quot;Medium Grid 3 Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;70&quot; Name=&quot;Dark List Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;71&quot; Name=&quot;Colorful Shading Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;72&quot; Name=&quot;Colorful List Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;73&quot; Name=&quot;Colorful Grid Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;60&quot; Name=&quot;Light Shading Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;61&quot; Name=&quot;Light List Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;62&quot; Name=&quot;Light Grid Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;63&quot; Name=&quot;Medium Shading 1 Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;64&quot; Name=&quot;Medium Shading 2 Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;65&quot; Name=&quot;Medium List 1 Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;66&quot; Name=&quot;Medium List 2 Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;67&quot; Name=&quot;Medium Grid 1 Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;68&quot; Name=&quot;Medium Grid 2 Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;69&quot; Name=&quot;Medium Grid 3 Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;70&quot; Name=&quot;Dark List Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;71&quot; Name=&quot;Colorful Shading Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;72&quot; Name=&quot;Colorful List Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;73&quot; Name=&quot;Colorful Grid Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;60&quot; Name=&quot;Light Shading Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;61&quot; Name=&quot;Light List Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;62&quot; Name=&quot;Light Grid Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;63&quot; Name=&quot;Medium Shading 1 Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;64&quot; Name=&quot;Medium Shading 2 Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;65&quot; Name=&quot;Medium List 1 Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;66&quot; Name=&quot;Medium List 2 Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;67&quot; Name=&quot;Medium Grid 1 Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;68&quot; Name=&quot;Medium Grid 2 Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;69&quot; Name=&quot;Medium Grid 3 Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;70&quot; Name=&quot;Dark List Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;71&quot; Name=&quot;Colorful Shading Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;72&quot; Name=&quot;Colorful List Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;73&quot; Name=&quot;Colorful Grid Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;60&quot; Name=&quot;Light Shading Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;61&quot; Name=&quot;Light List Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;62&quot; Name=&quot;Light Grid Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;63&quot; Name=&quot;Medium Shading 1 Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;64&quot; Name=&quot;Medium Shading 2 Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;65&quot; Name=&quot;Medium List 1 Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;66&quot; Name=&quot;Medium List 2 Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;67&quot; Name=&quot;Medium Grid 1 Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;68&quot; Name=&quot;Medium Grid 2 Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;69&quot; Name=&quot;Medium Grid 3 Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;70&quot; Name=&quot;Dark List Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;71&quot; Name=&quot;Colorful Shading Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;72&quot; Name=&quot;Colorful List Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;73&quot; Name=&quot;Colorful Grid Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;60&quot; Name=&quot;Light Shading Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;61&quot; Name=&quot;Light List Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;62&quot; Name=&quot;Light Grid Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;63&quot; Name=&quot;Medium Shading 1 Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;64&quot; Name=&quot;Medium Shading 2 Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;65&quot; Name=&quot;Medium List 1 Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;66&quot; Name=&quot;Medium List 2 Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;67&quot; Name=&quot;Medium Grid 1 Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;68&quot; Name=&quot;Medium Grid 2 Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;69&quot; Name=&quot;Medium Grid 3 Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;70&quot; Name=&quot;Dark List Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;71&quot; Name=&quot;Colorful Shading Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;72&quot; Name=&quot;Colorful List Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;73&quot; Name=&quot;Colorful Grid Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;60&quot; Name=&quot;Light Shading Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;61&quot; Name=&quot;Light List Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;62&quot; Name=&quot;Light Grid Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;63&quot; Name=&quot;Medium Shading 1 Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;64&quot; Name=&quot;Medium Shading 2 Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;65&quot; Name=&quot;Medium List 1 Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;66&quot; Name=&quot;Medium List 2 Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;67&quot; Name=&quot;Medium Grid 1 Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;68&quot; Name=&quot;Medium Grid 2 Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;69&quot; Name=&quot;Medium Grid 3 Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;70&quot; Name=&quot;Dark List Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;71&quot; Name=&quot;Colorful Shading Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;72&quot; Name=&quot;Colorful List Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;73&quot; Name=&quot;Colorful Grid Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;19&quot; QFormat=&quot;true&quot;   Name=&quot;Subtle Emphasis&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;21&quot; QFormat=&quot;true&quot;   Name=&quot;Intense Emphasis&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;31&quot; QFormat=&quot;true&quot;   Name=&quot;Subtle Reference&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;32&quot; QFormat=&quot;true&quot;   Name=&quot;Intense Reference&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;33&quot; QFormat=&quot;true&quot; Name=&quot;Book Title&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;37&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; Name=&quot;Bibliography&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;39&quot; SemiHidden=&quot;true&quot;   UnhideWhenUsed=&quot;true&quot; QFormat=&quot;true&quot; Name=&quot;TOC Heading&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;41&quot; Name=&quot;Plain Table 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;42&quot; Name=&quot;Plain Table 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;43&quot; Name=&quot;Plain Table 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;44&quot; Name=&quot;Plain Table 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;45&quot; Name=&quot;Plain Table 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;40&quot; Name=&quot;Grid Table Light&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;46&quot; Name=&quot;Grid Table 1 Light&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;47&quot; Name=&quot;Grid Table 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;48&quot; Name=&quot;Grid Table 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;49&quot; Name=&quot;Grid Table 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;50&quot; Name=&quot;Grid Table 5 Dark&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;51&quot; Name=&quot;Grid Table 6 Colorful&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;52&quot; Name=&quot;Grid Table 7 Colorful&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;46&quot;   Name=&quot;Grid Table 1 Light Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;47&quot; Name=&quot;Grid Table 2 Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;48&quot; Name=&quot;Grid Table 3 Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;49&quot; Name=&quot;Grid Table 4 Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;50&quot; Name=&quot;Grid Table 5 Dark Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;51&quot;   Name=&quot;Grid Table 6 Colorful Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;52&quot;   Name=&quot;Grid Table 7 Colorful Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;46&quot;   Name=&quot;Grid Table 1 Light Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;47&quot; Name=&quot;Grid Table 2 Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;48&quot; Name=&quot;Grid Table 3 Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;49&quot; Name=&quot;Grid Table 4 Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;50&quot; Name=&quot;Grid Table 5 Dark Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;51&quot;   Name=&quot;Grid Table 6 Colorful Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;52&quot;   Name=&quot;Grid Table 7 Colorful Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;46&quot;   Name=&quot;Grid Table 1 Light Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;47&quot; Name=&quot;Grid Table 2 Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;48&quot; Name=&quot;Grid Table 3 Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;49&quot; Name=&quot;Grid Table 4 Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;50&quot; Name=&quot;Grid Table 5 Dark Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;51&quot;   Name=&quot;Grid Table 6 Colorful Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;52&quot;   Name=&quot;Grid Table 7 Colorful Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;46&quot;   Name=&quot;Grid Table 1 Light Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;47&quot; Name=&quot;Grid Table 2 Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;48&quot; Name=&quot;Grid Table 3 Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;49&quot; Name=&quot;Grid Table 4 Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;50&quot; Name=&quot;Grid Table 5 Dark Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;51&quot;   Name=&quot;Grid Table 6 Colorful Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;52&quot;   Name=&quot;Grid Table 7 Colorful Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;46&quot;   Name=&quot;Grid Table 1 Light Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;47&quot; Name=&quot;Grid Table 2 Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;48&quot; Name=&quot;Grid Table 3 Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;49&quot; Name=&quot;Grid Table 4 Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;50&quot; Name=&quot;Grid Table 5 Dark Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;51&quot;   Name=&quot;Grid Table 6 Colorful Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;52&quot;   Name=&quot;Grid Table 7 Colorful Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;46&quot;   Name=&quot;Grid Table 1 Light Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;47&quot; Name=&quot;Grid Table 2 Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;48&quot; Name=&quot;Grid Table 3 Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;49&quot; Name=&quot;Grid Table 4 Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;50&quot; Name=&quot;Grid Table 5 Dark Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;51&quot;   Name=&quot;Grid Table 6 Colorful Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;52&quot;   Name=&quot;Grid Table 7 Colorful Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;46&quot; Name=&quot;List Table 1 Light&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;47&quot; Name=&quot;List Table 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;48&quot; Name=&quot;List Table 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;49&quot; Name=&quot;List Table 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;50&quot; Name=&quot;List Table 5 Dark&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;51&quot; Name=&quot;List Table 6 Colorful&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;52&quot; Name=&quot;List Table 7 Colorful&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;46&quot;   Name=&quot;List Table 1 Light Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;47&quot; Name=&quot;List Table 2 Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;48&quot; Name=&quot;List Table 3 Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;49&quot; Name=&quot;List Table 4 Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;50&quot; Name=&quot;List Table 5 Dark Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;51&quot;   Name=&quot;List Table 6 Colorful Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;52&quot;   Name=&quot;List Table 7 Colorful Accent 1&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;46&quot;   Name=&quot;List Table 1 Light Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;47&quot; Name=&quot;List Table 2 Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;48&quot; Name=&quot;List Table 3 Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;49&quot; Name=&quot;List Table 4 Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;50&quot; Name=&quot;List Table 5 Dark Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;51&quot;   Name=&quot;List Table 6 Colorful Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;52&quot;   Name=&quot;List Table 7 Colorful Accent 2&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;46&quot;   Name=&quot;List Table 1 Light Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;47&quot; Name=&quot;List Table 2 Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;48&quot; Name=&quot;List Table 3 Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;49&quot; Name=&quot;List Table 4 Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;50&quot; Name=&quot;List Table 5 Dark Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;51&quot;   Name=&quot;List Table 6 Colorful Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;52&quot;   Name=&quot;List Table 7 Colorful Accent 3&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;46&quot;   Name=&quot;List Table 1 Light Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;47&quot; Name=&quot;List Table 2 Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;48&quot; Name=&quot;List Table 3 Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;49&quot; Name=&quot;List Table 4 Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;50&quot; Name=&quot;List Table 5 Dark Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;51&quot;   Name=&quot;List Table 6 Colorful Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;52&quot;   Name=&quot;List Table 7 Colorful Accent 4&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;46&quot;   Name=&quot;List Table 1 Light Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;47&quot; Name=&quot;List Table 2 Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;48&quot; Name=&quot;List Table 3 Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;49&quot; Name=&quot;List Table 4 Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;50&quot; Name=&quot;List Table 5 Dark Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;51&quot;   Name=&quot;List Table 6 Colorful Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;52&quot;   Name=&quot;List Table 7 Colorful Accent 5&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;46&quot;   Name=&quot;List Table 1 Light Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;47&quot; Name=&quot;List Table 2 Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;48&quot; Name=&quot;List Table 3 Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;49&quot; Name=&quot;List Table 4 Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;50&quot; Name=&quot;List Table 5 Dark Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;51&quot;   Name=&quot;List Table 6 Colorful Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; Priority=&quot;52&quot;   Name=&quot;List Table 7 Colorful Accent 6&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Mention&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Smart Hyperlink&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Hashtag&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Unresolved Mention&quot;/&gt;  &lt;w:LsdException Locked=&quot;false&quot; SemiHidden=&quot;true&quot; UnhideWhenUsed=&quot;true&quot;   Name=&quot;Smart Link&quot;/&gt; &lt;/w:LatentStyles&gt;&lt;/xml&gt;&lt;![endif]--&gt;&lt;!--[if gte mso 10]&gt;&lt;style&gt; /* Style Definitions */ table.MsoNormalTable{mso-style-name:&quot;Table Normal&quot;;mso-tstyle-rowband-size:0;mso-tstyle-colband-size:0;mso-style-noshow:yes;mso-style-priority:99;mso-style-parent:&quot;&quot;;mso-padding-alt:0mm 5.4pt 0mm 5.4pt;mso-para-margin-top:0mm;mso-para-margin-right:0mm;mso-para-margin-bottom:8.0pt;mso-para-margin-left:0mm;line-height:107%;mso-pagination:widow-orphan;font-size:11.0pt;font-family:&quot;Calibri&quot;,sans-serif;mso-ascii-font-family:Calibri;mso-ascii-theme-font:minor-latin;mso-hansi-font-family:Calibri;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;mso-bidi-theme-font:minor-bidi;mso-ansi-language:EN-PH;}&lt;/style&gt;&lt;![endif]--&gt;&lt;p class=&quot;MsoNormal&quot; align=&quot;center&quot;&gt;&lt;span style=&quot;font-size:28px;color: rgb(53, 28, 117); line-height: 107%;&quot;&gt;About Us - MJB Water Refilling Station&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-size:9.0pt;line-height:107%;mso-ansi-language:EN-US&quot;&gt;Welcome to MJB Water Refilling Station! We are a small family businesslocated at Block 100, Lot 13, E. Jacinto St., Brgy. Rizal, Makati City. As alocally owned and operated enterprise, we take great pride in serving ourcommunity with the highest quality water products and excellent customerservice.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-size:9.0pt;line-height:107%;mso-ansi-language:EN-US&quot;&gt;At MJB Water Refilling Station, we are driven by our passion forproviding clean and safe drinking water to our customers. We understand theimportance of hydration and the role it plays in maintaining a healthylifestyle. With this in mind, we have committed ourselves to offer reliable andaffordable water solutions to meet the varying needs of our valued customers.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-size:9.0pt;line-height:107%;mso-ansi-language:EN-US&quot;&gt;Our team consists of generous and smart individuals who are dedicated todelivering exceptional service. We prioritize customer satisfaction above allelse, and we go the extra mile to ensure that every interaction with our staffis pleasant and rewarding. Whether you have questions about our products, needassistance with a water-related concern, or simply want to share feedback, weare always here to assist you.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-size:9.0pt;line-height:107%;mso-ansi-language:EN-US&quot;&gt;When it comes to the quality of our water, we leave no room forcompromise. We adhere to strict industry standards and employ state-of-the-artpurification processes to guarantee that the water we provide is free fromimpurities and contaminants. Our facility is equipped with advanced filtrationsystems, ensuring that every drop of water undergoes thorough purification tomeet the highest hygiene and safety standards.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-size:9.0pt;line-height:107%;mso-ansi-language:EN-US&quot;&gt;At MJB Water Refilling Station, we offer a wide range of water productsto suit different preferences and requirements. From purified drinking water toalkaline and mineralized options, we have something for everyone. Our productsare carefully packaged in sanitized containers, ensuring that freshness ispreserved until they reach your doorstep.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-size:9.0pt;line-height:107%;mso-ansi-language:EN-US&quot;&gt;We are here to make your water refilling experience convenient andhassle-free. In addition to our physical store, we also offer deliveryservices, allowing you to enjoy our products without leaving the comfort ofyour home or office. To place an order or inquire about our services, you canreach us at 8896-194 or 09568037097. Our friendly team will be more than happyto assist you.&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-size:9.0pt;line-height:107%;mso-ansi-language:EN-US&quot;&gt;Thank you for choosing MJB Water Refilling Station as your trustedsource of clean and refreshing water. We look forward to serving you and yourfamily for many years to come!&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-size:9.0pt;line-height:107%;mso-ansi-language:EN-US&quot;&gt;Sincerely,&lt;/span&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;span style=&quot;font-size:9.0pt;line-height:107%;mso-ansi-language:EN-US&quot;&gt;The MJB Water Refilling Station Team&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=admin , 2 = staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'admin', 'admin1234', 1),
(6, 'navo', 'navo', 'navo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `address` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address`) VALUES
(23, 'nav', 'rath', 'navrath@gmail.com', 'd72e5ee9b367833956ed9f88a960c686', '0944384924', 'phil');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-userid` (`user_id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_userid` (`user_id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orderid` (`order_id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk-userid` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_userid` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `fk_orderid` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
