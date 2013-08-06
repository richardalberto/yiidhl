<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<p:DCTRequest xmlns:p="http://www.dhl.com" xmlns:p1="http://www.dhl.com/datatypes" xmlns:p2="http://www.dhl.com/DCTRequestdatatypes" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dhl.com DCT-req.xsd ">
    <GetCapability>
        <Request>
            <ServiceHeader>
                <MessageTime>2002-08-20T11:28:56.000-08:00</MessageTime>
                <MessageReference>1234567890123456789012345678901</MessageReference>
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
            <Date><?php echo date('Y-m-d'); ?></Date>
            <ReadyTime>PT10H21M</ReadyTime>
            <ReadyTimeGMTOffset>+01:00</ReadyTimeGMTOffset>
            <DimensionUnit>CM</DimensionUnit>
            <WeightUnit>KG</WeightUnit>
            <Pieces>
                <Piece>
                <PieceID>1</PieceID>
                <Height>30</Height>
                <Depth>20</Depth>
                <Width>10</Width>
                <Weight>1.0</Weight>
                </Piece>
            </Pieces>      
            <IsDutiable>N</IsDutiable>
            <NetworkTypeCode>AL</NetworkTypeCode>
            <QtdShp>
                <QtdShpExChrg>
                    <SpecialServiceType>OSINFO</SpecialServiceType>
                </QtdShpExChrg>
            </QtdShp>
        </BkgDetails>
        <To>
            <CountryCode><?php echo $toCountryCode; ?></CountryCode>
            <Postalcode><?php echo $toPostalCode; ?></Postalcode>
            <City><?php echo $toCity; ?></City>
        </To>
        <Dutiable>
            <DeclaredCurrency>USD</DeclaredCurrency>
            <DeclaredValue>1002.00</DeclaredValue>
        </Dutiable>
    </GetCapability>
</p:DCTRequest>
