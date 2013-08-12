<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<p:DCTRequest xmlns:p="http://www.dhl.com" xmlns:p1="http://www.dhl.com/datatypes" xmlns:p2="http://www.dhl.com/DCTRequestdatatypes" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dhl.com DCT-req.xsd ">
    <GetCapability>
        <Request>
            <ServiceHeader>
                <SiteID><?php echo $siteId; ?></SiteID>
                <Password><?php echo $sitePassword; ?></Password>
            </ServiceHeader>
        </Request>
        <From>
            <CountryCode><?php echo $fromCountryCode; ?></CountryCode>
            <Postalcode><?php echo $fromPostalCode; ?></Postalcode>
            <City><?php echo $fromCity; ?></City>
        </From>
        <BkgDetails>
            <PaymentCountryCode><?php echo $fromCountryCode; ?></PaymentCountryCode>
            <Date><?php echo isset($shipDate) ? date('Y-m-d', strtotime($shipDate)) : date('Y-m-d'); ?></Date>
            <ReadyTime><?php echo isset($readyTime) ? date('\P\TH\Hi\M', strtotime($readyTime)) : date('\P\TH\Hi\M'); ?></ReadyTime>
            <DimensionUnit>IN</DimensionUnit>
            <WeightUnit>LB</WeightUnit>
            <?php if(isset($pieces) && count($pieces) > 0): ?>
            <?php foreach($pieces as $piece): ?>
            <Pieces>
                <Piece>
                    <PieceID><?php echo $piece['id']; ?></PieceID>
                    <Height><?php echo $piece['height']; ?></Height>
                    <Depth><?php echo $piece['depth']; ?></Depth>
                    <Width><?php echo $piece['width']; ?></Width>
                    <Weight><?php echo $piece['weight']; ?></Weight>
                </Piece>
            </Pieces>  
            <?php endforeach; ?><?php endif; ?>
            <IsDutiable>N</IsDutiable>
            <NetworkTypeCode>AL</NetworkTypeCode>
        </BkgDetails>
        <To>
            <CountryCode><?php echo $toCountryCode; ?></CountryCode>
            <Postalcode><?php echo $toPostalCode; ?></Postalcode>
            <City><?php echo $toCity; ?></City>
        </To>
    </GetCapability>
</p:DCTRequest>
