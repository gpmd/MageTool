<?php

class MageTool_Tool_MageExtension_Context_Extension_WsdlFile 
    extends Zend_Tool_Project_Context_Filesystem_File
{

    /**
     * @var string
     */
    protected $_filesystemName = 'wsdl.xml';

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'WsdlFile';
    }

    /**
     * getContents()
     *
     * @return string
     */
    public function getContents()
    {
        $profile = $this->_resource->getProfile();
        $vendor = $profile->getAttribute('vendor');
        $xmlVendor = strtolower($vendor);
        $name = $profile->getAttribute('name');
        $xmlName = strtolower($name);
        $pool = $profile->getAttribute('pool');

        return <<< EOS
<?xml version="1.0"?>
<!-- Remove this file if your module does not have profide an api -->
<definitions xmlns:typens="urn:{{var wsdl.name}}" 
    xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
    xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/" 
    xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/" xmlns="http://schemas.xmlsoap.org/wsdl/"
    name="{{var wsdl.name}}" targetNamespace="urn:{{var wsdl.name}}">
    <types>
        <schema xmlns="http://www.w3.org/2001/XMLSchema" targetNamespace="urn:Magento">
            <import namespace="http://schemas.xmlsoap.org/soap/encoding/" 
            schemaLocation="http://schemas.xmlsoap.org/soap/encoding/" />
        <!-- add complexType nodes here -->
        </schema>
    </types>
    <!-- add message nodes here -->
    <portType name="{{var wsdl.handler}}PortType">
        <!-- add operation nodes here -->
    </portType>
    <binding name="{{var wsdl.handler}}Binding" type="typens:{{var wsdl.handler}}PortType">
        <soap:binding style="rpc" transport="http://schemas.xmlsoap.org/soap/http" />
        <!-- add operation nodes here -->
    </binding>
</definitions>
EOS;
    }

}