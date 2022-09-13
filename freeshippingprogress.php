<?php
/**
* 2007-2022 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2022 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Freeshippingprogress extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'freeshippingprogress';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Valentin Duplan';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Free shipping progress bar');
        $this->description = $this->l('Add a free shipping progress bar in cart page.');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        Configuration::updateValue('FREESHIPPINGPROGRESS_PRICE', '0');
        Configuration::updateValue('FREESHIPPINGPROGRESS_IMG_LINK', false);

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader') &&
            $this->registerHook('displayShoppingCart');
    }

    public function uninstall()
    {
        Configuration::deleteByName('FREESHIPPINGPROGRESS_PRICE');
        Configuration::deleteByName('FREESHIPPINGPROGRESS_IMG_LINK');

        return parent::uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submitFreeshippingprogressModule')) == true) {
            $this->postProcess();
        }

        $this->context->smarty->assign(['module_dir' => $this->_path,
            'FREESHIPPINGPROGRESS_PRICE' => Configuration::get('FREESHIPPINGPROGRESS_PRICE'),
            'FREESHIPPINGPROGRESS_IMG_LINK' => Configuration::get('FREESHIPPINGPROGRESS_IMG_LINK'),
            'img' =>  '../modules/'.$this->name.'/views/img/'.Configuration::get('FREESHIPPINGPROGRESS_IMG_LINK'),
        ]);
        
        return $this->display(__FILE__, 'views/templates/admin/configure.tpl');        
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        if (isset($_FILES['FREESHIPPINGPROGRESS_IMG_LINK']) && isset($_FILES['FREESHIPPINGPROGRESS_IMG_LINK']['size']) && $_FILES['FREESHIPPINGPROGRESS_IMG_LINK']['size'] > 0) {
            if ($error = ImageManager::validateUpload($_FILES['FREESHIPPINGPROGRESS_IMG_LINK'], 4000000)) {
                return $this->displayError($this->l('Invalid image.'));
            } else {
                $ext = Tools::substr($_FILES['FREESHIPPINGPROGRESS_IMG_LINK']['name'], strrpos($_FILES['FREESHIPPINGPROGRESS_IMG_LINK']['name'], '.') + 1);
                //$file_name = md5($_FILES['STORE_LOCATOR_IMG']['name']) . '.' . $ext;
                if (!move_uploaded_file($_FILES['FREESHIPPINGPROGRESS_IMG_LINK']['tmp_name'], dirname(__FILE__) . '/views/img/img2.' . $ext)) {
                    return $this->displayError($this->l('An error occurred while attempting to upload the file.'));
                } else{
                    @unlink(dirname(__FILE__) . '/views/img/' . Configuration::get('FREESHIPPINGPROGRESS_IMG_LINK'));
                    rename(dirname(__FILE__) . '/views/img/img2.' . $ext,dirname(__FILE__) . '/views/img/img.' . $ext);
                    Configuration::updateValue('FREESHIPPINGPROGRESS_IMG_LINK', 'img.' . $ext);
                    ImageManager::resize(dirname(__FILE__) . '/views/img/' .Configuration::get('FREESHIPPINGPROGRESS_IMG_LINK'), dirname(__FILE__) . '/views/img/' .Configuration::get('FREESHIPPINGPROGRESS_IMG_LINK'), 30, 30, $ext);
                }
            }
        }
        if(is_nan(Tools::getValue('FREESHIPPINGPROGRESS_PRICE')) !== false){
            return $this->displayError($this->l('Amount format is not valid'));
        } else {
            Configuration::updateValue('FREESHIPPINGPROGRESS_PRICE', str_replace(',', '.', Tools::getValue('FREESHIPPINGPROGRESS_PRICE')));
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

    public function hookDisplayShoppingCart()
    {
        /* Place your code here. */
    }
}
