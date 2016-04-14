<?php
$heading_1 = "CONTAINER STUFFING SURVEY REPORT";
$text_1_1 = "We, the undersigned marine surveyors, do hereby certify that at the request of %s did attend at the %s on %s in order to";
$text_1_2 = "- Inspect the container prior to vanning of Rough granite blocks\r"; 
$text_1_2 .= "- Supervise the vanning operation of and securing arrangements of the granite blocks\r";
$text_1_2 .= "- And after a careful examination we now report as follows.";
$heading_2 = "2.0".space(2)."DETAILS OF CONSIGNMENT: (AS DECLARED) "; 
$heading_3 = "3.0".space(2)."PRE-STOW / CHOCKING MATERIALS:"; 
$text_3_1 =space(5)."Based on the packing list dimensions, the required list of chocking material was advised to the C & F Agents.";
  

$heading_4 = "4.0".space(2)."OUR SURVEY/FINDINGS:";
$text_4_1 = space(5)."We attended at %s on %s and we report as under:";

$text_4_2 = "4.1".space(2)."Prior to packing the cargo into container, the nominated %s Containers were inspected by us and found in a satisfactory condition.";

$heading_5 = "5.0".space(2)."INSPECTION OF CARGO AND WEIGHT LIMITS / DISTRIBUTION:";

$text_5_1 = "6.0".space(2)."We physically measured the %s Granite Block%s. The actual measurements were found at considerable variance with the declared measurements by as much as 30 cms.";

$text_5_2 = space(5)."The Gross weight of the block is as per bills provided by C&F (Individual granite    blocks not weighed by us). These weights were taken into consideration for calculating number of blocks per container basis payload capacity of the container.";

$heading_6 = "7.0".space(2)."STOWAGE & SECURING:"; 

$text_6_1 = "7.1".space(2)."As a precautionary measures, prior to packing the cargo into container,	floorboard of the container was inspected prior to packing / unpacking operation.";

$text_6_2 = "7.2".space(2)."All the timber used for load spreading / chocking were of commercial grade (untreated) quality.";
$text_6_3 = "7.3".space(2)."The packing and securing operations were carried out on %s in our presence, in accordance with the stowage plan advised.";
$text_6_4 = "7.4".space(2)."At the time of packing the cargo into container, no structural damages were caused to the container panels or floorboard.";

$heading_7 = "The details of the Processed Dimensional Granite Blocks loaded into the containers are as under:";

$graniteDetails_header = array("Sl.No", "Container Number", "Max.Gr Wt.(in Kgs)", "Max. Pay-load(in Kgs)", "Granite weight as per CHA (in Mts) ", "Number Of Blocks", "Block Numbers", "Customs / Line Seal Number", "Date of Mfg");

$heading_8 = "8.0".space(2)."CARGO SECURING DETAILS CONTAINER WISE:";
$text_8_1 = space(5).'a.'.space(2)."No of wooden bearers laid on the floor : %s\" x %s\" x %s' = %s piece%s\n";
$text_8_2 = space(5)."b.".space(2)."No of wooden bolsters / framework on the sides of the blocks:\n";
$text_8_3 = space(9)."Left Side\t: Wooden Bolsters at %s place%s\n";
$text_8_4 = "Wooden Frameworks at %s place%s\n";
$text_8_5 = space(9)."Right Side\t: Wooden Bolsters at %s place%s\n";
$text_8_6 = "Wooden Frameworks at %s place%s\n";
$text_8_7 = space(9)."No of wooden wedges nailed to the floor at the end of the blocks\n";
$text_8_8 = space(9)."At front end: %s piece%s \t\t At rear end: %s piece%s";

$heading_9 = "9.0".space(2)."SURVEY REMARKS:";
$text_9_1 = space(5)."We finally inspected the stowage & securing arrangements on %s. Based on our inspection as outlined above, we are of the opinion that:\n"; 
$text_9_1 .= space(5)."a.".space(2)."The cargo consisting of %s Granite block%s had been stowed compactly in %s containers.\n";
$text_9_1 .= space(5)."b.".space(2)."The securing arrangements were sufficient for the intended sea passage.\n";
$text_9_1 .= space(5)."This report is not a pre shipment inspection for LC or Grade of the cargo and or for Quarantine purposes, but confined to stowage and inspection of securing arrangements.";

$heading_10 = "This report is not intended for Insurance purpose valid at the time / date / place of inspection.";

function space($no = 1) {
  return str_repeat(chr(32), $no);
}
?>
