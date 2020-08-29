<?php
namespace Pdf\Download\Block;
class ListProduct extends \Magento\Framework\View\Element\Template
{

    protected $productFactory;
    protected $fileFactory;

    public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Block\Product\ListProduct $productFactory,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory)
	{
		parent::__construct($context);
        $this->productFactory = $productFactory;
        $this->fileFactory = $fileFactory;
	}

    public function sayHello()
	{
        $pdf = new \Zend_Pdf();
        $pdf->pages[] = $pdf->newPage(\Zend_Pdf_Page::SIZE_A4);
        $page = $pdf->pages[0]; // this will get reference to the first page.
        $style = new \Zend_Pdf_Style();
        $style->setLineColor(new \Zend_Pdf_Color_Rgb(0,0,0));
        $font = \Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_TIMES);
        $style->setFont($font,15);
        $page->setStyle($style);
        $width = $page->getWidth();
        $hight = $page->getHeight();
        $x = 30;
        $pageTopalign = 850; //default PDF page height
        $this->y = 850 - 100; //print table row from page top – 100px
        //Draw table header row’s
        $style->setFont($font,16);
        $page->setStyle($style);
        $page->drawRectangle(30, $this->y + 10, $page->getWidth()-30, $this->y +70, \Zend_Pdf_Page::SHAPE_DRAW_STROKE);
        $style->setFont($font,15);
        $page->setStyle($style);
        $page->drawText(__("kk"), $x + 5, $this->y+50, 'UTF-8');
        $style->setFont($font,11);
        $page->setStyle($style);
        $page->drawText(__("Name : %1", "John Smith"), $x + 5, $this->y+33, 'UTF-8');
        $page->drawText(__("Email : %1","test@example.com"), $x + 5, $this->y+16, 'UTF-8');

        $style->setFont($font,12);
        $page->setStyle($style);
        $page->drawText(__("PRODUCT NAME"), $x + 60, $this->y-10, 'UTF-8');
        $page->drawText(__("PRICE"), $x + 200, $this->y-10, 'UTF-8');
        $page->drawText(__("QUANTITY"), $x + 310, $this->y-10, 'UTF-8');
        $page->drawText(__("TOTAL"), $x + 440, $this->y-10, 'UTF-8');

        $style->setFont($font,10);
        $page->setStyle($style);
        $add = 9;
        $page->drawText("$10.00", $x + 210, $this->y-30, 'UTF-8');
        $page->drawText(5, $x + 330, $this->y-30, 'UTF-8');
        $page->drawText("$50.00", $x + 470, $this->y-30, 'UTF-8');
        $pro = "ABC product";
        $page->drawText($pro, $x + 65, $this->y-30, 'UTF-8');
        $page->drawRectangle(30, $this->y -62, $page->getWidth()-30, $this->y + 10, \Zend_Pdf_Page::SHAPE_DRAW_STROKE);
        $page->drawRectangle(30, $this->y -62, $page->getWidth()-30, $this->y - 100, \Zend_Pdf_Page::SHAPE_DRAW_STROKE);
        $style->setFont($font,15);
        $page->setStyle($style);
        $page->drawText(__("Total : %1", "$50.00"), $x + 435, $this->y-85, 'UTF-8');
        $style->setFont($font,10);
        $page->setStyle($style);
        $page->drawText(__("ABC Footer example"), ($page->getWidth()/2)-50, $this->y-200);

        $fileName = 'example.pdf';

        $this->fileFactory->create(
           $fileName,
           $pdf->render(),
           \Magento\Framework\App\Filesystem\DirectoryList::VAR_DIR, // this pdf will be saved in var directory with the name example.pdf
           'application/pdf'
        );
		return __('Hello World 3');
	}
    


}