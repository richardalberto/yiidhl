<?php echo '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<req:KnownTrackingRequest xmlns:req="http://www.dhl.com" 
						xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
						xsi:schemaLocation="http://www.dhl.com
						TrackingRequestKnown.xsd">
	<Request>
		<ServiceHeader>
                    <MessageTime><?php echo date("c"); ?></MessageTime>
                    <MessageReference>1234567890123456789012345678</MessageReference>
                    <SiteID><?php echo $siteId; ?></SiteID>
                    <Password><?php echo $passwd; ?></Password>
                </ServiceHeader>
        </Request>
        <LanguageCode>en</LanguageCode>
        <AWBNumber><?php echo $airbill; ?></AWBNumber>
        <LevelOfDetails>ALL_CHECK_POINTS</LevelOfDetails>
</req:KnownTrackingRequest>