<?php

namespace Items\ItemInformation\Helper;

use Integration\FedEx\Api\FedExDataAuthInterface;

class XmlBuilder
{
    /**
     * Build XML in order to make a request to FedEx API
     * 
     * @param int $zipCode
     * @param int $requestedQuantity
     * @return string
     */
    public function buildXmlFedEx($zipCode, $requestedQuantity)
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:v26="http://fedex.com/ws/rate/v26" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
            <soapenv:Body>
                <v26:RateRequest>
                    <v26:WebAuthenticationDetail>
                        <v26:UserCredential>
                            <v26:Key>'.FedExDataAuthInterface::KEY.'</v26:Key>
                            <v26:Password>'.FedExDataAuthInterface::PASSWORD.'</v26:Password>
                        </v26:UserCredential>
                    </v26:WebAuthenticationDetail>
                    <v26:ClientDetail>
                        <v26:AccountNumber>'.FedExDataAuthInterface::ACCOUNT_NUMBER.'</v26:AccountNumber>
                        <v26:MeterNumber>'.FedExDataAuthInterface::METER_NUMBER.'</v26:MeterNumber>
                    </v26:ClientDetail>
                    <v26:TransactionDetail>
                        <v26:CustomerTransactionId>SO444</v26:CustomerTransactionId>
                    </v26:TransactionDetail>
                    <v26:Version>
                        <v26:ServiceId>crs</v26:ServiceId>
                        <v26:Major>26</v26:Major>
                        <v26:Intermediate>0</v26:Intermediate>
                        <v26:Minor>0</v26:Minor>
                    </v26:Version>
                    <v26:RequestedShipment>
                        <v26:Shipper>
                            <v26:Address>
                                <v26:StreetLines>5640 W. MAPLE</v26:StreetLines>
                                <v26:City>W. BLOOMFIELD</v26:City>
                                <v26:StateOrProvinceCode>MI</v26:StateOrProvinceCode>
                                <v26:PostalCode>48322</v26:PostalCode>
                                <v26:CountryCode>US</v26:CountryCode>
                            </v26:Address>
                        </v26:Shipper>
                        <v26:Recipient>
                            <v26:Contact>
                                <v26:CompanyName>4th Dimension Promotnl Prdts</v26:CompanyName>
                            </v26:Contact>
                            <v26:Address>
                                <v26:StreetLines>771 Indian Springs Road</v26:StreetLines>
                                <v26:City>Indiana</v26:City>
                                <v26:StateOrProvinceCode>PA</v26:StateOrProvinceCode>
                                <v26:PostalCode>15701</v26:PostalCode>
                                <v26:CountryCode>US</v26:CountryCode>
                            </v26:Address>
                        </v26:Recipient>
                        <v26:CustomsClearanceDetail>
                            <v26:DutiesPayment>
                                <v26:PaymentType>SENDER</v26:PaymentType>
                                <v26:Payor>
                                    <v26:ResponsibleParty>
                                        <v26:AccountNumber>510087780</v26:AccountNumber>
                                    </v26:ResponsibleParty>
                                </v26:Payor>
                            </v26:DutiesPayment>
                        </v26:CustomsClearanceDetail>
                        <v26:PackageCount>1</v26:PackageCount>
                        <v26:RequestedPackageLineItems>
                            <v26:SequenceNumber>1</v26:SequenceNumber>
                            <v26:GroupPackageCount>1</v26:GroupPackageCount>
                            <v26:Weight>
                                <v26:Units>LB</v26:Units>
                                <v26:Value>15.3</v26:Value>
                            </v26:Weight>
                            <v26:Dimensions>
                                <v26:Length>4</v26:Length>
                                <v26:Width>8</v26:Width>
                                <v26:Height>4</v26:Height>
                                <v26:Units>IN</v26:Units>
                            </v26:Dimensions>
                        </v26:RequestedPackageLineItems>
                    </v26:RequestedShipment>
                </v26:RateRequest>
            </soapenv:Body>
        </soapenv:Envelope>';

        return $xml;
    }
}