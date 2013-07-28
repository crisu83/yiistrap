<?php
use Codeception\Util\Stub;

Yii::import('bootstrap.helpers.TbHtml');
Yii::import('bootstrap.tests.unit.Dummy');

class TbHtmlTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testLead()
    {
        $lead = TbHtml::lead('Lead text');
        $this->assertEquals('<p class="lead">Lead text</p>', $lead);
    }

    public function testSmall()
    {
        $small = TbHtml::small('Small text');
        $this->assertEquals('<small>Small text</small>', $small);
    }

    public function testBold()
    {
        $bold = TbHtml::b('Bold text');
        $this->assertEquals('<strong>Bold text</strong>', $bold);
    }

    public function testItalic()
    {
        $italic = TbHtml::i('Italic text');
        $this->assertEquals('<em>Italic text</em>', $italic);
    }

    public function testEmphasize()
    {
        $muted = TbHtml::em('Muted text', array('muted' => true));
        $this->assertEquals('<p class="muted">Muted text</p>', $muted);
        $warning = TbHtml::em('Warning text', array('color' => TbHtml::TEXT_COLOR_WARNING));
        $this->assertEquals('<p class="text-warning">Warning text</p>', $warning);
        $success = TbHtml::em('Success text', array('color' => TbHtml::TEXT_COLOR_SUCCESS), 'span');
        $this->assertEquals('<span class="text-success">Success text</span>', $success);
    }

    public function testMuted()
    {
        $muted = TbHtml::muted('Muted text');
        $this->assertEquals('<p class="muted">Muted text</p>', $muted);
    }

    public function testMutedSpan()
    {
        $muted = TbHtml::mutedSpan('Muted text');
        $this->assertEquals('<span class="muted">Muted text</span>', $muted);
    }

    public function testAbbrivation()
    {
        $abbr = TbHtml::abbr('Abbrivation', 'Word');
        $this->assertEquals('<abbr title="Word">Abbrivation</abbr>', $abbr);
    }

    public function testSmallAbbrivation()
    {
        $abbr = TbHtml::smallAbbr('Abbrivation', 'Word');
        $this->assertEquals('<abbr class="initialism" title="Word">Abbrivation</abbr>', $abbr);
    }

    public function testAddress()
    {
        $address = TbHtml::address('Address text');
        $this->assertEquals('<address>Address text</address>', $address);
    }

    public function testQuote()
    {
        $quote = TbHtml::quote('Quote text', array(
            'paragraphOptions' => array('class' => 'paragraph'),
            'source' => 'Source text',
            'sourceOptions' => array('class' => 'source'),
            'cite' => 'Cited text',
            'citeOptions' => array('class' => 'cite'),
        ));
        $this->assertEquals('<blockquote><p class="paragraph">Quote text</p><small class="source">Source text <cite class="cite">Cited text</cite></small></blockquote>', $quote);
    }

    public function testHelp()
    {
        $help = TbHtml::help('Help text');
        $this->assertEquals('<span class="help-inline">Help text</span>', $help);
    }

    public function testHelpBlock()
    {
        $help = TbHtml::helpBlock('Help text');
        $this->assertEquals('<p class="help-block">Help text</p>', $help);
    }

    public function testCode()
    {
        $code = TbHtml::code('Code text');
        $this->assertEquals('<code>Code text</code>', $code);
    }

    public function testCodeBlock()
    {
        $code = TbHtml::codeBlock('Code text');
        $this->assertEquals('<pre>Code text</pre>', $code);
    }

    public function testTag()
    {
        $div = TbHtml::tag('div', array(
            'textAlign' => TbHtml::TEXT_ALIGN_RIGHT,
            'pull' => TbHtml::PULL_RIGHT,
            'span' => 3,
        ), 'Content');
        $this->assertEquals('<div class="span3 pull-right text-right">Content</div>', $div);
    }

    public function testOpenTag()
    {
        $tag = TbHtml::openTag('p');
        $this->assertEquals('<p>', $tag);
    }

    public function testForm()
    {
        $form = TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_VERTICAL, '#');
        $this->assertEquals('<form class="form-vertical" action="#" method="post">', $form);
    }

    public function testTextField()
    {
        $input = TbHtml::textField('text', 'text', array(
            'class' => 'text',
        ));
        $this->assertEquals('<input class="text" type="text" value="text" name="text" id="text" />', $input);
        $input = TbHtml::textField('text', 'text', array(
            'prepend' => 'Prepend text',
        ));
        $this->assertEquals('<div class="input-prepend"><span class="add-on">Prepend text</span><input type="text" value="text" name="text" id="text" /></div>', $input);
        $input = TbHtml::textField('text', 'text', array(
            'append' => 'Append text',
        ));
        $this->assertEquals('<div class="input-append"><input type="text" value="text" name="text" id="text" /><span class="add-on">Append text</span></div>', $input);
        $input = TbHtml::textField('text', 'text', array(
            'prepend' => 'Prepend text',
            'append' => 'Append text',
        ));
        $this->assertEquals('<div class="input-append input-prepend"><span class="add-on">Prepend text</span><input type="text" value="text" name="text" id="text" /><span class="add-on">Append text</span></div>', $input);

    }

    public function testPasswordField()
    {
        $input = TbHtml::passwordField('password', 'secret', array(
            'class' => 'password',
        ));
        $this->assertEquals('<input class="password" type="password" value="secret" name="password" id="password" />', $input);
    }

    public function testUrlField()
    {
        $input = TbHtml::urlField('url', 'http://www.getyiistrap.com', array(
            'class' => 'url',
        ));
        $this->assertEquals('<input class="url" type="url" value="http://www.getyiistrap.com" name="url" id="url" />', $input);
    }

    public function testEmailField()
    {
        $input = TbHtml::emailField('email', 'christoffer.niska@gmail.com', array(
            'class' => 'email',
        ));
        $this->assertEquals('<input class="email" type="email" value="christoffer.niska@gmail.com" name="email" id="email" />', $input);
    }

    public function testNumberField()
    {
        $input = TbHtml::numberField('number', 42, array(
            'class' => 'number',
        ));
        $this->assertEquals('<input class="number" type="number" value="42" name="number" id="number" />', $input);
    }

    public function testRangeField()
    {
        $input = TbHtml::rangeField('range', 3.33, array(
            'class' => 'range',
        ));
        $this->assertEquals('<input class="range" type="range" value="3.33" name="range" id="range" />', $input);
    }

    public function testDateField()
    {
        $input = TbHtml::dateField('date', '2013-07-27', array(
            'class' => 'date',
        ));
        $this->assertEquals('<input class="date" type="date" value="2013-07-27" name="date" id="date" />', $input);
    }

    public function testTextArea()
    {
        $input = TbHtml::textArea('textArea', 'text', array(
            'class' => 'textarea',
        ));
        $this->assertEquals('<textarea class="textarea" name="textArea" id="textArea">text</textarea>', $input);
    }

    public function testRadioButton()
    {
        $input = TbHtml::radioButton('radio', false, array(
            'class' => 'radio'
        ));
        $this->assertEquals('<input class="radio" type="radio" value="1" name="radio" id="radio" />', $input);
        $input = TbHtml::radioButton('radio', false, array(
            'label' => 'Label text',
        ));
        $this->assertEquals('<label class="radio"><input type="radio" value="1" name="radio" id="radio" /> Label text</label>', $input);
    }

    public function testCheckBox()
    {
        $input = TbHtml::checkBox('checkbox', true, array(
            'class' => 'checkbox'
        ));
        $this->assertEquals('<input class="checkbox" checked="checked" type="checkbox" value="1" name="checkbox" id="checkbox" />', $input);
        $input = TbHtml::checkBox('checkbox', true, array(
            'label' => 'Label text',
        ));
        $this->assertEquals('<label class="checkbox"><input checked="checked" type="checkbox" value="1" name="checkbox" id="checkbox" /> Label text</label>', $input);
    }

    public function testDropDownList()
    {
        // todo: write this.
    }

    public function testListBox()
    {
        // todo: write this.
    }

    public function testRadioButtonList()
    {
        // todo: write this.
    }

    public function testInlineRadioButtonList()
    {
        // todo: write this.
    }

    public function testCheckboxList()
    {
        // todo: write this.
    }

    public function testInlineCheckBoxList()
    {
        // todo: write this.
    }

    public function testUneditableField()
    {
        $input = TbHtml::uneditableField('Uneditable text', array(
            'class' => 'uneditable',
        ));
        $this->assertEquals('<span class="uneditable uneditable-input">Uneditable text</span>', $input);
    }

    public function testSearchQueryField()
    {
        $input = TbHtml::searchQueryField('search', 'Search query', array(
            'class' => 'search',
        ));
        $this->assertEquals('<input class="search search-query" type="text" value="Search query" name="search" id="search" />', $input);
    }

    public function testControlGroup()
    {
        $controlGroup = TbHtml::controlGroup(TbHtml::INPUT_TYPE_TEXT, 'text', '', array(
            'color' => TbHtml::INPUT_COLOR_SUCCESS,
            'groupOptions' => array('class' => 'group'),
            'label' => 'Label text',
            'labelOptions' => array('class' => 'label'),
            'help' => 'Help text',
            'helpOptions' => array('class' => 'help'),
        ));
        $this->assertEquals('<div class="group control-group success"><label class="label control-label" for="text">Label text</label><div class="controls"><input type="text" value="" name="text" id="text" /><span class="help help-inline">Help text</span></div></div>', $controlGroup);
        $controlGroup = TbHtml::controlGroup(TbHtml::INPUT_TYPE_RADIOBUTTON, 'radio', true, array(
            'label' => 'Label text',
            'labelOptions' => array('class' => 'label'),
        ));
        $this->assertEquals('<div class="control-group"><div class="controls"><label class="label radio"><input checked="checked" type="radio" value="1" name="radio" id="radio" /> Label text</label></div></div>', $controlGroup);
    }

    public function testCustomControlGroup()
    {
        $controlGroup = TbHtml::customControlGroup('<div class="widget"></div>', 'custom', array(
            'label' => false,
        ));
        $this->assertEquals('<div class="control-group"><div class="controls"><div class="widget"></div></div></div>', $controlGroup);
    }

    public function testActiveTextField()
    {
        $model = new Dummy;
        $input = TbHtml::activeTextField($model, 'text', array(
            'class' => 'text'
        ));
        $this->assertEquals('<input class="text" name="Dummy[text]" id="Dummy_text" type="text" value="text" />', $input);
        $input = TbHtml::activeTextField($model, 'text', array(
            'prepend' => 'Prepend text',
        ));
        $this->assertEquals('<div class="input-prepend"><span class="add-on">Prepend text</span><input name="Dummy[text]" id="Dummy_text" type="text" value="text" /></div>', $input);
        $input = TbHtml::activeTextField($model, 'text', array(
            'append' => 'Append text',
        ));
        $this->assertEquals('<div class="input-append"><input name="Dummy[text]" id="Dummy_text" type="text" value="text" /><span class="add-on">Append text</span></div>', $input);
        $input = TbHtml::activeTextField($model, 'text', array(
            'prepend' => 'Prepend text',
            'append' => 'Append text',
        ));
        $this->assertEquals('<div class="input-append input-prepend"><span class="add-on">Prepend text</span><input name="Dummy[text]" id="Dummy_text" type="text" value="text" /><span class="add-on">Append text</span></div>', $input);
    }

    public function testActivePasswordField()
    {
        $model = new Dummy;
        $input = TbHtml::activePasswordField($model, 'password', array(
            'class' => 'password'
        ));
        $this->assertEquals('<input class="password" name="Dummy[password]" id="Dummy_password" type="password" value="secret" />', $input);
    }

    public function testActiveUrlField()
    {
        $model = new Dummy;
        $input = TbHtml::activeUrlField($model, 'url', array(
            'class' => 'url'
        ));
        $this->assertEquals('<input class="url" name="Dummy[url]" id="Dummy_url" type="url" value="http://www.getyiistrap.com" />', $input);
    }

    public function testActiveEmailField()
    {
        $model = new Dummy;
        $input = TbHtml::activeEmailField($model, 'email', array(
            'class' => 'email'
        ));
        $this->assertEquals('<input class="email" name="Dummy[email]" id="Dummy_email" type="email" value="christoffer.niska@gmail.com" />', $input);
    }

    public function testActiveNumberField()
    {
        $model = new Dummy;
        $input = TbHtml::activeNumberField($model, 'number', array(
            'class' => 'number'
        ));
        $this->assertEquals('<input class="number" name="Dummy[number]" id="Dummy_number" type="number" value="42" />', $input);
    }

    public function testActiveRangeField()
    {
        $model = new Dummy;
        $input = TbHtml::activeRangeField($model, 'range', array(
            'class' => 'range'
        ));
        $this->assertEquals('<input class="range" name="Dummy[range]" id="Dummy_range" type="range" value="3.33" />', $input);
    }

    public function testActiveDateField()
    {
        $model = new Dummy;
        $input = TbHtml::activeDateField($model, 'date', array(
            'class' => 'date'
        ));
        $this->assertEquals('<input class="date" name="Dummy[date]" id="Dummy_date" type="date" value="2013-07-27" />', $input);
    }

    public function testActiveRadioButton()
    {
        $model = new Dummy;
        $input = TbHtml::activeRadioButton($model, 'radio', array(
            'class' => 'radio'
        ));
        $this->assertEquals('<input id="ytDummy_radio" type="hidden" value="0" name="Dummy[radio]" /><input class="radio" name="Dummy[radio]" id="Dummy_radio" value="1" checked="checked" type="radio" />', $input);
        $input = TbHtml::activeRadioButton($model, 'radio', array(
            'label' => 'Label text'
        ));
        $this->assertEquals('<label class="radio"><input id="ytDummy_radio" type="hidden" value="0" name="Dummy[radio]" /><input name="Dummy[radio]" id="Dummy_radio" value="1" checked="checked" type="radio" /> Label text</label>', $input);
    }

    public function testActiveCheckBox()
    {
        $model = new Dummy;
        $input = TbHtml::activeCheckBox($model, 'checkbox', array(
            'class' => 'checkbox'
        ));
        $this->assertEquals('<input id="ytDummy_checkbox" type="hidden" value="0" name="Dummy[checkbox]" /><input class="checkbox" name="Dummy[checkbox]" id="Dummy_checkbox" value="1" type="checkbox" />', $input);
        $input = TbHtml::activeCheckBox($model, 'checkbox', array(
            'label' => 'Label text'
        ));
        $this->assertEquals('<label class="checkbox"><input id="ytDummy_checkbox" type="hidden" value="0" name="Dummy[checkbox]" /><input name="Dummy[checkbox]" id="Dummy_checkbox" value="1" type="checkbox" /> Label text</label>', $input);
    }

    public function testActiveDropDownList()
    {
        // todo: write this.
    }

    public function testActiveListBox()
    {
        // todo: write this.
    }

    public function testActiveRadioButtonList()
    {
        // todo: write this.
    }

    public function testActiveInlineRadioButtonList()
    {
        // todo: write this.
    }

    public function testActiveCheckBoxList()
    {
        // todo: write this.
    }

    public function testActiveInlineCheckBoxList()
    {
        // todo: write this.
    }

    public function testActiveUneditableField()
    {
        $model = new Dummy;
        $input = TbHtml::activeUneditableField($model, 'uneditable', array(
            'class' => 'uneditable'
        ));
        $this->assertEquals('<span class="uneditable uneditable-input">Uneditable text</span>', $input);
    }

    public function testActiveSearchQueryField()
    {
        $model = new Dummy;
        $input = TbHtml::activeSearchQueryField($model, 'search', array(
            'class' => 'search'
        ));
        $this->assertEquals('<input class="search search-query" name="Dummy[search]" id="Dummy_search" type="text" value="Search query" />', $input);
    }

    public function testActiveControlGroup()
    {
        $model = new Dummy;
        $controlGroup = TbHtml::activeControlGroup(TbHtml::INPUT_TYPE_TEXT, $model, 'text', array(
            'color' => TbHtml::INPUT_COLOR_ERROR,
            'groupOptions' => array('class' => 'group'),
            'labelOptions' => array('class' => 'label'),
            'help' => 'Help text',
            'helpOptions' => array('class' => 'help'),
        ));
        $this->assertEquals('<div class="group control-group error"><label class="label control-label" for="Dummy_text">Text</label><div class="controls"><input name="Dummy[text]" id="Dummy_text" type="text" value="text" /><span class="help help-inline">Help text</span></div></div>', $controlGroup);
        $controlGroup = TbHtml::activeControlGroup(TbHtml::INPUT_TYPE_RADIOBUTTON, $model, 'radio', array(
            'labelOptions' => array('class' => 'label'),
        ));
        $this->assertEquals('<div class="control-group"><div class="controls"><label class="label radio"><input id="ytDummy_radio" type="hidden" value="0" name="Dummy[radio]" /><input name="Dummy[radio]" id="Dummy_radio" value="1" checked="checked" type="radio" /> Radio</label></div></div>', $controlGroup);
    }

    public function testActiveCustomControlGroup()
    {
        $model = new Dummy;
        $controlGroup = TbHtml::customActiveControlGroup('<div class="widget"></div>', $model, 'text', array(
            'label' => false,
        ));
        $this->assertEquals('<div class="control-group"><div class="controls"><div class="widget"></div></div></div>', $controlGroup);
    }

    public function testErrorSummary()
    {
        // todo: write this.
    }

    public function testError()
    {
        $model = new Dummy;
        $model->addError('text', 'Error text');
        $error = TbHtml::error($model, 'text', array(
            'class' => 'error',
        ));
        $this->assertEquals('<span class="error help-inline">Error text</span>', $error);
    }

    public function testControls()
    {
        $controls = TbHtml::controls('<div class="control"></div><div class="control"></div>', array(
            'before' => 'Before text',
            'after' => 'After text',
        ));
        $this->assertEquals('<div class="controls">Before text<div class="control"></div><div class="control"></div>After text</div>', $controls);
    }

    public function testControlsRow()
    {
        $controls = TbHtml::controlsRow(array(
            '<div class="control"></div>',
            '<div class="control"></div>',
        ));
        $this->assertEquals('<div class="controls controls-row"><div class="control"></div><div class="control"></div></div>', $controls);
    }

    public function testFormActions()
    {
        $actions = TbHtml::formActions('<div class="action"></div><div class="action"></div>');
        $this->assertEquals('<div class="form-actions"><div class="action"></div><div class="action"></div></div>', $actions);
        $actions = TbHtml::formActions(array(
            '<div class="action"></div>',
            '<div class="action"></div>',
        ));
        $this->assertEquals('<div class="form-actions"><div class="action"></div><div class="action"></div></div>', $actions);
    }

    public function testSearchForm()
    {
        // todo: write this.
    }

    public function testNavbarForm()
    {
        // todo: write this.
    }

    public function testNavbarSearchForm()
    {
        // todo: write this.
    }

    public function testLink()
    {
        $link = TbHtml::link('Link', '#', array(
            'class' => 'link'
        ));
        $this->assertEquals('<a class="link" href="#">Link</a>', $link);
    }

    public function testButton()
    {
        $button = TbHtml::button('Button', array(
            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
            'size' => TbHtml::BUTTON_SIZE_LARGE,
        ));
        $this->assertEquals('<button class="btn btn-primary btn-large" name="yt0" type="button">Button</button>', $button);
        CHtml::$count = 0;
        $button = TbHtml::button('Button', array(
            'block' => true,
        ));
        $this->assertEquals('<button class="btn btn-block" name="yt0" type="button">Button</button>', $button);
        CHtml::$count = 0;
        $button = TbHtml::button('Button', array(

            'disabled' => true,
        ));
        $this->assertEquals('<button class="btn disabled" name="yt0" type="button">Button</button>', $button);
        CHtml::$count = 0;
        $button = TbHtml::button('Button', array(
            'loading' => 'Loading text',
        ));
        $this->assertEquals('<button class="btn" data-loading-text="Loading text" name="yt0" type="button">Button</button>', $button);
        CHtml::$count = 0;
        $button = TbHtml::button('Button', array(
            'toggle' => true,
        ));
        $this->assertEquals('<button class="btn" data-toggle="button" name="yt0" type="button">Button</button>', $button);
        CHtml::$count = 0;
        $button = TbHtml::button('Button', array(
            'icon' => TbHtml::ICON_OK,
        ));
        $this->assertEquals('<button class="btn" name="yt0" type="button"><i class="icon-ok"></i> Button</button>', $button);
        CHtml::$count = 0;
        // todo: test button dropdowns as well.
    }

    public function testHtmlButton()
    {
        $button = TbHtml::htmlButton('Button', array(
            'class' => 'button',
        ));
        $this->assertEquals('<button class="button btn" name="yt0" type="button">Button</button>', $button);
        CHtml::$count = 0;
    }

    public function testSubmitButton()
    {
        $button = TbHtml::submitButton('Submit', array(
            'class' => 'submit'
        ));
        $this->assertEquals('<button class="submit btn" type="submit" name="yt0">Submit</button>', $button);
        CHtml::$count = 0;
    }

    public function testResetButton()
    {
        $button = TbHtml::resetButton('Reset', array(
            'class' => 'reset',
        ));
        $this->assertEquals('<button class="reset btn" type="reset" name="yt0">Reset</button>', $button);
        CHtml::$count = 0;
    }

    public function testImageButton()
    {
        $button = TbHtml::imageButton('button.png', array(
            'class' => 'image',
        ));
        $this->assertEquals('<input class="image btn" src="button.png" type="image" name="yt0" value="submit" />', $button);
        CHtml::$count = 0;
    }

    public function testLinkButton()
    {
        $button = TbHtml::linkButton('Link', array(
            'class' => 'link',
        ));
        $this->assertEquals('<a class="link btn" href="#">Link</a>', $button);
        CHtml::$count = 0;
    }

    public function testAjaxLink()
    {
        $button = TbHtml::ajaxLink('Link', '#', array(), array(
            'class' => 'link',
        ));
        $this->assertEquals('<a class="link btn" href="#" id="yt0">Link</a>', $button);
        CHtml::$count = 0;
    }

    public function testAjaxButton()
    {
        $button = TbHtml::ajaxButton('Button', '#', array(), array(
            'class' => 'button',
        ));
        $this->assertEquals('<button class="button btn" name="yt0" type="button" id="yt0">Button</button>', $button);
        CHtml::$count = 0;
    }

    public function testAjaxSubmitButton()
    {
        $button = TbHtml::ajaxSubmitButton('Submit', '#', array(), array(
            'class' => 'button',
        ));
        $this->assertEquals('<button class="button btn" type="submit" name="yt0" id="yt0">Submit</button>', $button);
        CHtml::$count = 0;
    }

    public function testImageRounded()
    {
        $image = TbHtml::imageRounded('image.png', 'Alternative text', array(
            'class' => 'image',
        ));
        $this->assertEquals('<img class="image img-rounded" src="image.png" alt="Alternative text" />', $image);
    }

    public function testImageCircle()
    {
        $image = TbHtml::imageCircle('image.png', 'Alternative text', array(
                'class' => 'image',
            ));
        $this->assertEquals('<img class="image img-circle" src="image.png" alt="Alternative text" />', $image);
    }

    public function testImagePolaroid()
    {
        $image = TbHtml::imagePolaroid('image.png', 'Alternative text', array(
                'class' => 'image',
            ));
        $this->assertEquals('<img class="image img-polaroid" src="image.png" alt="Alternative text" />', $image);
    }

    public function testIcon()
    {
        $icon = TbHtml::icon(TbHtml::ICON_OK, array(
            'class' => 'icon',
        ));
        $this->assertEquals('<i class="icon icon-ok"></i>', $icon);
        $icon = TbHtml::icon(TbHtml::ICON_REMOVE, array(
            'color' => TbHtml::ICON_COLOR_WHITE,
        ));
        $this->assertEquals('<i class="icon-remove icon-white"></i>', $icon);
        $icon = TbHtml::icon('pencil white');
        $this->assertEquals('<i class="icon-pencil icon-white"></i>', $icon);
    }

    public function testDropdown()
    {
        // todo: write this.
    }

    public function testDropdownToggleLink()
    {
        $button = TbHtml::dropdownToggleLink('Link', array(
            'class' => 'button',
        ));
        $this->assertEquals('<a class="button dropdown-toggle btn" data-toggle="dropdown" href="#">Link <b class="caret"></b></a>', $button);
    }

    public function testDropdownToggleButton()
    {
        $button = TbHtml::dropdownToggleButton('Button', array(
            'class' => 'button',
        ));
        $this->assertEquals('<button class="button dropdown-toggle btn" data-toggle="dropdown" name="yt0" type="button">Button <b class="caret"></b></button>', $button);
        CHtml::$count = 0;
    }

    public function testDropdownToggleMenuLink()
    {
        $link = TbHtml::dropdownToggleMenuLink('Link', '#', array(
            'class' => 'link',
        ));
        $this->assertEquals('<a class="link dropdown-toggle" data-toggle="dropdown" href="#">Link <b class="caret"></b></a>', $link);
    }

    public function testButtonGroup()
    {
        // todo: write this.
    }

    public function testButtonToolbar()
    {
        // todo: write this.
    }

    public function testButtonDropdown()
    {
        // todo: write this.
    }

    public function testSplitButtonDropdown()
    {
        // todo: write this.
    }

    public function testTabs()
    {
        // todo: write this.
    }

    public function testStackedTabs()
    {
        // todo: write this.
    }

    public function testPills()
    {
        // todo: write this.
    }

    public function testStackedPills()
    {
        // todo: write this.
    }

    public function testNavList()
    {
        // todo: write this.
    }

    public function testNav()
    {
        // todo: write this.
    }

    public function testMenu()
    {
        // todo: write this.
    }

    public function testMenuLink()
    {
        $item = TbHtml::menuLink('Link', '#', array(
            'class' => 'item',
            'linkOptions' => array('class' => 'link'),
        ));
        $this->assertEquals('<li class="item"><a class="link" href="#">Link</a></li>', $item);
    }

    public function testMenuDropdown()
    {
        // todo: write this.
    }

    public function testMenuHeader()
    {
        $item = TbHtml::menuHeader('Header text', array(
            'class' => 'item',
        ));
        $this->assertEquals('<li class="item nav-header">Header text</li>', $item);
    }

    public function testMenuDivider()
    {
        $divider = TbHtml::menuDivider(array(
            'class' => 'item',
        ));
        $this->assertEquals('<li class="item divider" />', $divider);
    }

    public function testTabbable()
    {
        // todo: write this.
    }

    public function testTabbableTabs()
    {
        // todo: write this.
    }

    public function testTabbablePills()
    {
        // todo: write this.
    }

    public function testNavbar()
    {
        $navbar = TbHtml::navbar('<div class="content"></div>', array(
            'class' => 'nav',
            'innerOptions' => array('class' => 'inner'),
        ));
        $this->assertEquals('<div class="nav navbar"><div class="inner navbar-inner"><div class="content"></div></div></div>', $navbar);
        $navbar = TbHtml::navbar('', array(
            'display' => TbHtml::NAVBAR_DISPLAY_FIXEDTOP,
        ));
        $this->assertEquals('<div class="navbar navbar-fixed-top"><div class="navbar-inner"></div></div>', $navbar);
        $navbar = TbHtml::navbar('', array(
            'color' => TbHtml::NAVBAR_COLOR_INVERSE,
        ));
        $this->assertEquals('<div class="navbar navbar-inverse"><div class="navbar-inner"></div></div>', $navbar);
    }

    public function testNavbarBrandLink()
    {
        $link = TbHtml::navbarBrandLink('Brand text', '#', array(
            'class' => 'text',
        ));
        $this->assertEquals('<a class="text brand" href="#">Brand text</a>', $link);
    }

    public function testNavbarText()
    {
        $text = TbHtml::navbarText('Navbar text', array(
            'class' => 'text',
        ));
        $this->assertEquals('<p class="text navbar-text">Navbar text</p>', $text);
    }

    public function testNavbarMenuDivider()
    {
        $divider = TbHtml::navbarMenuDivider(array(
            'class' => 'item',
        ));
        $this->assertEquals('<li class="item divider-vertical" />', $divider);
    }

    public function testBreadcrumbs()
    {
        // todo: write this.
    }

    public function testPagination()
    {
        // todo: write this.
    }

    public function testPaginationLink()
    {
        $link = TbHtml::paginationLink('Link', '#', array(
            'class' => 'link',
            'itemOptions' => array('class' => 'item'),
        ));
        $this->assertEquals('<li class="item"><a class="link" href="#">Link</a></li>', $link);
    }

    public function testPager()
    {
        // todo: write this.
    }

    public function testPagerLink()
    {
        $link = TbHtml::pagerLink('Link', '#', array(
            'class' => 'link',
            'itemOptions' => array('class' => 'item'),
            'disabled' => true,
        ));
        $this->assertEquals('<li class="item disabled"><a class="link" href="#">Link</a></li>', $link);
        $link = TbHtml::pagerLink('Previous', '#', array(
            'previous' => true,
        ));
        $this->assertEquals('<li class="previous"><a href="#">Previous</a></li>', $link);
        $link = TbHtml::pagerLink('Next', '#', array(
            'next' => true,
        ));
        $this->assertEquals('<li class="next"><a href="#">Next</a></li>', $link);
    }

    public function testLabel()
    {
        $label = TbHtml::labelTb('Label text', array(
            'color' => TbHtml::LABEL_COLOR_INFO,
            'class' => 'text',
        ));
        $this->assertEquals('<span class="text label label-info">Label text</span>', $label);
    }

    public function testBadge()
    {
        $badge = TbHtml::badge('Badge text', array(
            'color' => TbHtml::BADGE_COLOR_WARNING,
            'class' => 'text',
        ));
        $this->assertEquals('<span class="text badge badge-warning">Badge text</span>', $badge);
    }

    public function testHeroUnit()
    {
        $heroUnit = TbHtml::heroUnit('Heading text', 'Content text', array(
            'class' => 'hero',
            'headingOptions' => array('class' => 'heading'),
        ));
        $this->assertEquals('<div class="hero hero-unit"><h1 class="heading">Heading text</h1>Content text</div>', $heroUnit);
    }

    public function testPageHeader()
    {
        $pageHeader = TbHtml::pageHeader('Heading text', 'Subtext', array(
            'class' => 'header',
            'headerOptions' => array('class' => 'heading'),
            'subtextOptions' => array('class' => 'subtext')
        ));
        $this->assertEquals('<div class="header page-header"><h1 class="heading">Heading text <small class="subtext">Subtext</small></h1></div>', $pageHeader);
    }

    public function testThumbnails()
    {
        // todo: write this.
    }

    public function testThumbnail()
    {
        $thumbnail = TbHtml::thumbnail('Thumbnail text', array(
            'class' => 'div',
            'itemOptions' => array('class' => 'item'),
        ));
        $this->assertEquals('<li class="item"><div class="div thumbnail">Thumbnail text</div></li>', $thumbnail);
    }

    public function testThumbnailLink()
    {
        $thumbnail = TbHtml::thumbnailLink('Thumbnail text', '#', array(
            'class' => 'link',
            'itemOptions' => array('class' => 'item'),
        ));
        $this->assertEquals('<li class="item"><a class="link thumbnail" href="#">Thumbnail text</a></li>', $thumbnail);
    }

    public function testAlert()
    {
        $alert = TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, 'Alert message');
        $this->assertEquals('<div class="alert alert-success in fade"><a href="#" class="close" data-dismiss="alert" type="button">&times;</a>Alert message</div>', $alert);
        $alert = TbHtml::alert(TbHtml::ALERT_COLOR_INFO, 'Alert message', array(
            'closeText' => false,
        ));
        $this->assertEquals('<div class="alert alert-info in fade">Alert message</div>', $alert);
        $alert = TbHtml::alert(TbHtml::ALERT_COLOR_DANGER, 'Alert message', array(
            'class' => 'message',
            'in' => false,
            'fade' => false,
            'closeText' => 'Close',
            'closeOptions' => array('class' => 'text'),
        ));
        $this->assertEquals('<div class="message alert alert-danger"><a class="text close" href="#" data-dismiss="alert" type="button">Close</a>Alert message</div>', $alert);
    }

    public function testBlockAlert()
    {
        $alert = TbHtml::blockAlert(TbHtml::ALERT_COLOR_WARNING, 'Alert message');
        $this->assertEquals('<div class="alert alert-warning in alert-block fade"><a href="#" class="close" data-dismiss="alert" type="button">&times;</a>Alert message</div>', $alert);
    }

    public function testProgressBar()
    {
        $progress = TbHtml::progressBar(60, array(
            'class' => 'div',
            'color' => TbHtml::PROGRESS_COLOR_INFO,
            'content' => 'Bar text',
        ));
        $this->assertEquals('<div class="div progress progress-info"><div class="bar" style="width: 60%;">Bar text</div></div>', $progress);
        $progress = TbHtml::progressBar(35, array(
            'barOptions' => array('color' => TbHtml::PROGRESS_COLOR_SUCCESS),
        ));
        $this->assertEquals('<div class="progress"><div class="bar bar-success" style="width: 35%;"></div></div>', $progress);
        $progress = TbHtml::progressBar(-1);
        $this->assertEquals('<div class="progress"><div class="bar" style="width: 0%;"></div></div>', $progress);
        $progress = TbHtml::progressBar(100.1);
        $this->assertEquals('<div class="progress"><div class="bar" style="width: 100%;"></div></div>', $progress);
    }

    public function testStripedProgressBar()
    {
        $progress = TbHtml::stripedProgressBar(20);
        $this->assertEquals('<div class="progress progress-striped"><div class="bar" style="width: 20%;"></div></div>', $progress);
    }

    public function testAnimatedProgressBar()
    {
        $progress = TbHtml::animatedProgressBar(40);
        $this->assertEquals('<div class="progress progress-striped active"><div class="bar" style="width: 40%;"></div></div>', $progress);
    }

    public function testStackedProgressBar()
    {
        $progress = TbHtml::stackedProgressBar(array(
            array('color' => TbHtml::PROGRESS_COLOR_SUCCESS, 'width' => 35),
            array('color' => TbHtml::PROGRESS_COLOR_WARNING, 'width' => 20),
            array('color' => TbHtml::PROGRESS_COLOR_DANGER, 'width' => 10),
        ));
        $this->assertEquals('<div class="progress"><div class="bar bar-success" style="width: 35%;"></div><div class="bar bar-warning" style="width: 20%;"></div><div class="bar bar-danger" style="width: 10%;"></div></div>', $progress);
        $progress = TbHtml::stackedProgressBar(array(
            array('width' => 35),
            array('width' => 20),
            array('width' => 100),
        ));
        $this->assertEquals('<div class="progress"><div class="bar" style="width: 35%;"></div><div class="bar" style="width: 20%;"></div><div class="bar" style="width: 45%;"></div></div>', $progress);
        $progress = TbHtml::stackedProgressBar(array(
            array('width' => 35),
            array('width' => 20),
            array('width' => 10, 'visible' => false),
        ));
        $this->assertEquals('<div class="progress"><div class="bar" style="width: 35%;"></div><div class="bar" style="width: 20%;"></div></div>', $progress);
    }

    public function testMediaObjects()
    {
        // todo: write this.
    }

    public function testMediaObject()
    {
        // todo: write this.
    }

    public function testWell()
    {
        $well = TbHtml::well('Well text', array(
            'class' => 'div',
            'size' => TbHtml::WELL_SIZE_LARGE,
        ));
        $this->assertEquals('<div class="div well well-large">Well text</div>', $well);
    }

    public function testCloseLink()
    {
        $link = TbHtml::closeLink('Close', '#', array(
            'class' => 'link',
            'dismiss' => TbHtml::CLOSE_DISMISS_ALERT,
        ));
        $this->assertEquals('<a class="link close" href="#" data-dismiss="alert" type="button">Close</a>', $link);
    }

    public function testCloseButton()
    {
        $button = TbHtml::closeButton('Close', array(
            'dismiss' => TbHtml::CLOSE_DISMISS_MODAL,
            'class' => 'button',
        ));
        $this->assertEquals('<button class="button close" data-dismiss="modal" type="button">Close</button>', $button);
    }


    public function testCollapseLink()
    {
        $link = TbHtml::collapseLink('Link', '#', array(
            'class' => 'link',
        ));
        $this->assertEquals('<a class="link" data-toggle="collapse" href="#">Link</a>', $link);
    }

    public function testTooltip()
    {
        // todo: write this.
    }

    public function testPopover()
    {
        // todo: write this.
    }

    public function testCarousel()
    {
        // todo: write this.
    }

    public function testCarouselItem()
    {
        // todo: write this.
    }

    public function testCarouselPrevLink()
    {
        $link = TbHtml::carouselPrevLink('Previous', '#', array(
            'class' => 'link',
        ));
        $this->assertEquals('<a class="link carousel-control left" data-slide="prev" href="#">Previous</a>', $link);
    }

    public function testCarouselNextLink()
    {
        $link = TbHtml::carouselNextLink('Next', '#', array(
                'class' => 'link',
            ));
        $this->assertEquals('<a class="link carousel-control right" data-slide="next" href="#">Next</a>', $link);
    }

    public function testCarouselIndicators()
    {
        $indicators = TbHtml::carouselIndicators('#', 3, array(
            'class' => 'list',
        ));
        $this->assertEquals('<ol class="list carousel-indicators"><li data-target="#" data-slide-to="0" class="active"></li><li data-target="#" data-slide-to="1"></li><li data-target="#" data-slide-to="2"></li></ol>', $indicators);
    }
}