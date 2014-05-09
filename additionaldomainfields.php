<?php


// do not create function or classes here and use include_once

$_LANG['idnCode'] = 'IDN Code Country';
$_LANG['idnCodeDescription'] = 'Code of Internationalized Domain Name';

include_once dirname(__file__)."/namecheapapi.php";


$showIdnCodeSelection = false;

if (!empty($_POST['domain'])) {
    list($sld, $tld) = explode(".", $_POST['domain'], 2);
    $oIDNA = new NamecheapRegistrarIDNA($sld, $tld);
    $showIdnCodeSelection = $oIDNA->sldWasEncoded();
}
else if (isset($_SESSION['cart']['domains']) && sizeof($_SESSION['cart']['domains']))
{
    foreach($_SESSION['cart']['domains'] as $cartDomain) {
        list($sld, $tld) = explode(".", $cartDomain['domain'], 2);
        $oIDNA = new NamecheapRegistrarIDNA($sld, $tld);
        if ($oIDNA->sldWasEncoded()) {
            $showIdnCodeSelection = true;
            break;
        }
    }
}




if ($showIdnCodeSelection) {
    
    $idnCodesOptions = implode(",", array_keys($oIDNA->getCodeOptions()));
    
    foreach($oIDNA->getTldList() as $tld) {
        foreach($additionaldomainfields[".".$tld] as $additionalField) {
            if ($additionalField['Name'] == 'idnCode')
                continue 2;
        }
        $additionaldomainfields[".".$tld][] = array("Name" => "idnCode", "LangVar" => 'idnCode', "Type" => "dropdown", "Options" => $idnCodesOptions, 'Description' => $_LANG['idnCodeDescription']);
    }
}


// .ca tld additional fields
$additionaldomainfields[".ca"][] = array("Name" => "Job Title", "LangVar"=>"cajobtitle", "Type" => "text", "Size" => "30", "Default" => "", "Required" => false, "Description"=>"Required for non-individual registrants only");

// .fr tld additional fields
$additionaldomainfields[".fr"][] = array("Name" => "Legal Type", "LangVar"=>"frlegaltype", "Type" => "dropdown", "Options"=>"Company,Individual", "Default" => "Individual", "Required" => true, "Description" => '');
$additionaldomainfields[".fr"][] = array("Name" => "Date of Birth", "LangVar"=>"frregistrantbirthdate", "Type" => "text", "Size" => "30", "Default" => "", "Required" => false, "Description" => "The registrant's date of birth in the form YYYY-MM-DD");
$additionaldomainfields[".fr"][] = array("Name" => "Place of Birth", "LangVar"=>"frregistrantbirthplace", "Type" => "text", "Size" => "30", "Default" => "", "Required" => false, "Description" => "The registrant's place of birth. French registrants have to provide the place of birth in the form [ZIP code,City] (e.g. \"78181, Saint Quentin en Yvelines Cedex\"). Non-French registrants simply have to provide the [TWO-LETTER COUNTRY CODE] of their country of birth (e.g. \"DE\")");
$additionaldomainfields[".fr"][] = array("Name" => "Legal Id", "LangVar"=>"frregistrantlegalid", "Type" => "text", "Size" => "30", "Default" => "", "Required" => false, "Description" => "French company with a SIREN or SIRET number should continue to provide this number instead as legal id. The SIREN (Système d’Identification du Répertoire des Entreprises) number is the first part of the SIRET NUMBER and consists of 9 digits. The SIRET (Système d’Identification du Répertoire des Etablissements) number is a unique identification number with 14 digits");
$additionaldomainfields[".fr"][] = array("Name" => "Trade Number", "LangVar"=>"frregistranttradenumber", "Type" => "text", "Size" => "30", "Default" => "", "Required" => false, "Description" => "Companies with a European trademark:For companies with a European trademark can additionally add their trademark number using this extension");
$additionaldomainfields[".fr"][] = array("Name" => "Duns Number", "LangVar"=>"frregistrantdunsnumber", "Type" => "text", "Size" => "30", "Default" => "", "Required" => false, "Description" => "The DUNS number is a nine-digit number, issued by Dun & Bradstreet. DUNS is the abbreviation of Data Universal Numbering System. Companies with a valid DUNS number are still obliged having their head office in the territory of the European Union. The DUNS number can be provided using this extension");
$additionaldomainfields[".fr"][] = array("Name" => "Local Id", "LangVar"=>"frregistrantlocalid", "Type" => "text", "Size" => "30", "Default" => "", "Required" => false, "Description" => "Companies with a local identifier specific to a country of the European Economic Area can provide their local identifier using this extension");
$additionaldomainfields[".fr"][] = array("Name" => "Journal Date of Declaration", "LangVar"=>"frregistrantjodatedec", "Type" => "text", "Size" => "30", "Default" => "", "Required" => false, "Description" => "French associations listed with the Journal Officiel de la République Française - The official gazette of the French Republic: The Journal Official Associations publishes notices of creations, breakup or substantial changes with nonprofit associations in France. Using the website http://www.societe.com and the database they provide, query for the respective data below to register a .FR domain name. - The date of declaration of the association in the form YYYY-MM-DD");
$additionaldomainfields[".fr"][] = array("Name" => "Journal Date of Publication", "LangVar"=>"frregistrantjodatepub", "Type" => "text", "Size" => "30", "Default" => "", "Required" => false, "Description" => "The date of publication in the Journal Officiel in the form YYYY-MM-DD");

$additionaldomainfields[".fr"][] = array("Name" => "Journal Number", "LangVar"=>"frregistrantjonumber", "Type" => "text", "Size" => "30", "Default" => "", "Required" => false, 'Description' => 'The page of the announcement in the Journal Officiel');
$additionaldomainfields[".fr"][] = array("Name" => "Journal Page", "LangVar"=>"frregistrantjopage", "Type" => "text", "Size" => "30", "Default" => "", "Required" => false, 'Description' => 'The page of the announcement in the Journal Officiel');

// .au job title
$additionaldomainfields[".com.au"][] = array("Name" => "Job Title", "LangVar"=>"aujobtitle", "Type" => "text", "Size" => "30", "Default" => "", "Required" => true, "Description"=>"");
$additionaldomainfields[".net.au"] = $additionaldomainfields[".com.au"];
$additionaldomainfields[".org.au"] = $additionaldomainfields[".com.au"];

$additionaldomainfields['.com.es'] = $additionaldomainfields[".es"];
$additionaldomainfields['.nom.es'] = $additionaldomainfields[".es"];
$additionaldomainfields['.org.es'] = $additionaldomainfields[".es"];


// asia cc locality
$bAddField = true;
foreach($additionaldomainfields['.asia'] as $v){
    if($v['Name']=='Locality'){$bAddField = false;}
}
if($bAddField){
    $additionaldomainfields[".asia"][] = array(
        "Name" => "Locality",
        "Type" => "dropdown",
        "Options" => "af,bd,ck,in,jp,kg,mh,nz,ps,sg,th,tv,aq,bt,cy,id,kz,la,fm,nu,pg,sb,tl,ae,am,bn,fj,ir,ki,lb,mn,nf,ph,lk,tk,uz,au,kh,ge,iq,kp,mo,mm,om,qa,sy,to,vu,az,cn,hm,il,kr,my,nr,pk,ws,tw,tr,vn,bh,cc,hk,jo,kw,mv,np,pw,sa,tj,tm,ye"
    );
}

