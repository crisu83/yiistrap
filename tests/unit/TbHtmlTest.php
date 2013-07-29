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
        $html = TbHtml::lead('Lead text');
        $p = $this->codeGuy->createNode($html, 'p.lead');
        $this->codeGuy->seeNodeText($p, 'Lead text');
    }

    public function testSmall()
    {
        $html = TbHtml::small('Small text');
        $small = $this->codeGuy->createNode($html, 'small');
        $this->codeGuy->seeNodeText($small, 'Small text');
    }

    public function testBold()
    {
        $html = TbHtml::b('Bold text');
        $strong = $this->codeGuy->createNode($html, 'strong');
        $this->codeGuy->seeNodeText($strong, 'Bold text');
    }

    public function testItalic()
    {
        $html = TbHtml::i('Italic text');
        $em = $this->codeGuy->createNode($html, 'em');
        $this->codeGuy->seeNodeText($em, 'Italic text');
    }

    public function testEmphasize()
    {
        $html = TbHtml::em(
            'Warning text',
            array(
                'color' => TbHtml::TEXT_COLOR_WARNING,
            )
        );
        $span = $this->codeGuy->createNode($html, 'p.text-warning');
        $this->codeGuy->seeNodeText($span, 'Warning text');

        $html = TbHtml::em(
            'Success text',
            array(
                'color' => TbHtml::TEXT_COLOR_SUCCESS,
            ),
            'span'
        );
        $span = $this->codeGuy->createNode($html, 'span.text-success');
        $this->codeGuy->seeNodeText($span, 'Success text');
    }

    public function testMuted()
    {
        $html = TbHtml::muted('Muted text');
        $p = $this->codeGuy->createNode($html, 'p.muted');
        $this->codeGuy->seeNodeText($p, 'Muted text');
    }

    public function testMutedSpan()
    {
        $html = TbHtml::mutedSpan('Muted text');
        $span = $this->codeGuy->createNode($html, 'span.muted');
        $this->codeGuy->seeNodeText($span, 'Muted text');
    }

    public function testAbbreviation()
    {
        $html = TbHtml::abbr('Abbreviation', 'Word');
        $abbr = $this->codeGuy->createNode($html, 'abbr');
        $this->codeGuy->seeNodeAttribute($abbr, 'title', 'Word');
        $this->codeGuy->seeNodeText($abbr, 'Abbreviation');
    }

    public function testSmallAbbreviation()
    {
        $html = TbHtml::smallAbbr('Abbreviation', 'Word');
        $abbr = $this->codeGuy->createNode($html, 'abbr');
        $this->codeGuy->seeNodeAttribute($abbr, 'title', 'Word');
        $this->codeGuy->seeNodeCssClass($abbr, 'initialism');
        $this->codeGuy->seeNodeText($abbr, 'Abbreviation');
    }

    public function testAddress()
    {
        $html = TbHtml::address('Address text');
        $addr = $this->codeGuy->createNode($html, 'address');
        $this->codeGuy->seeNodeText($addr, 'Address text');
    }

    public function testQuote()
    {
        $html = TbHtml::quote(
            'Quote text',
            array(
                'paragraphOptions' => array('class' => 'paragraph'),
                'source' => 'Source text',
                'sourceOptions' => array('class' => 'source'),
                'cite' => 'Cited text',
                'citeOptions' => array('class' => 'cite'),
            )
        );
        $blockquote = $this->codeGuy->createNode($html, 'blockquote');
        $this->codeGuy->seeNodeChildren($blockquote, array('p', 'small'));
        $p = $blockquote->filter('p');
        $this->codeGuy->seeNodeCssClass($p, 'paragraph');
        $this->codeGuy->seeNodeText($p, 'Quote text');
        $small = $blockquote->filter('blockquote > small');
        $this->codeGuy->seeNodeCssClass($small, 'source');
        $this->codeGuy->seeNodeText($small, 'Source text');
        $cite = $small->filter('small > cite');
        $this->codeGuy->seeNodeCssClass($cite, 'cite');
        $this->codeGuy->seeNodeText($cite, 'Cited text');
        // todo: consider writing a test including the pull-right quote as well.
    }

    public function testHelp()
    {
        $html = TbHtml::help('Help text');
        $span = $this->codeGuy->createNode($html, 'span.help-inline');
        $this->codeGuy->seeNodeText($span, 'Help text');
    }

    public function testHelpBlock()
    {
        $html = TbHtml::helpBlock('Help text');
        $p = $this->codeGuy->createNode($html, 'p.help-block');
        $this->codeGuy->seeNodeText($p, 'Help text');
    }

    public function testCode()
    {
        $html = TbHtml::code('Source code');
        $code = $this->codeGuy->createNode($html, 'code');
        $this->codeGuy->seeNodeText($code, 'Source code');
    }

    public function testCodeBlock()
    {
        $html = TbHtml::codeBlock('Source code');
        $pre = $this->codeGuy->createNode($html, 'pre');
        $this->codeGuy->seeNodeText($pre, 'Source code');
    }

    public function testTag()
    {
        $html = TbHtml::tag(
            'div',
            array(
                'textAlign' => TbHtml::TEXT_ALIGN_RIGHT,
                'pull' => TbHtml::PULL_RIGHT,
                'span' => 3,
            ),
            'Content'
        );
        $div = $this->codeGuy->createNode($html, 'div');
        $this->codeGuy->seeNodeCssClass($div, 'pull-right span3 text-right');
    }

    public function testOpenTag()
    {
        $html = TbHtml::openTag(
            'p',
            array(
                'class' => 'tag',
            )
        );
        $p = $this->codeGuy->createNode($html, 'p');
        $this->codeGuy->seeNodeCssClass($p, 'tag');
    }

    public function testForm()
    {
        $html = TbHtml::beginFormTb(TbHtml::FORM_LAYOUT_VERTICAL, '#');
        $form = $this->codeGuy->createNode($html, 'form');
        $this->codeGuy->seeNodeAttributes(
            $form,
            array(
                'class' => 'form-vertical',
                'action' => '#',
                'method' => 'post'
            )
        );
    }

    public function testTextField()
    {
        $html = TbHtml::textField(
            'text',
            'text',
            array(
                'class' => 'input',
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=text]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'class' => 'input',
                'id' => 'text',
                'name' => 'text',
                'value' => 'text',
            )
        );

        $html = TbHtml::textField(
            'text',
            'text',
            array(
                'prepend' => 'Prepend text',
            )
        );
        $div = $this->codeGuy->createNode($html, 'div');
        $this->codeGuy->seeNodeCssClass($div, 'input-prepend');
        $this->codeGuy->seeNodeChildren($div, array('span', 'input'));
        $span = $div->filter('div > span.add-on');
        $this->codeGuy->seeNodeText($span, 'Prepend text');

        $html = TbHtml::textField(
            'text',
            'text',
            array(
                'append' => 'Append text',
            )
        );
        $div = $this->codeGuy->createNode($html, 'div');
        $this->codeGuy->seeNodeCssClass($div, 'input-append');
        $this->codeGuy->seeNodeChildren($div, array('input', 'span'));
        $span = $div->filter('div > span.add-on');
        $this->codeGuy->seeNodeText($span, 'Append text');

        $html = TbHtml::textField(
            'text',
            'text',
            array(
                'prepend' => 'Prepend text',
                'append' => 'Append text',
            )
        );
        $div = $this->codeGuy->createNode($html, 'div');
        $this->codeGuy->seeNodeCssClass($div, 'input-prepend input-append');
        $this->codeGuy->seeNodeChildren($div, array('span', 'input', 'span'));
    }

    public function testPasswordField()
    {
        $html = TbHtml::passwordField(
            'password',
            'secret',
            array(
                'class' => 'input',
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=password]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'class' => 'input',
                'id' => 'password',
                'name' => 'password',
                'value' => 'secret',
            )
        );
    }

    public function testUrlField()
    {
        $html = TbHtml::urlField(
            'url',
            'http://www.getyiistrap.com',
            array(
                'class' => 'input',
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=url]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'class' => 'input',
                'id' => 'url',
                'name' => 'url',
                'value' => 'http://www.getyiistrap.com',
            )
        );
    }

    public function testEmailField()
    {
        $html = TbHtml::emailField(
            'email',
            'christoffer.niska@gmail.com',
            array(
                'class' => 'input',
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=email]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'class' => 'input',
                'id' => 'email',
                'name' => 'email',
                'value' => 'christoffer.niska@gmail.com',
            )
        );
    }

    public function testNumberField()
    {
        $html = TbHtml::numberField(
            'number',
            42,
            array(
                'class' => 'input',
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=number]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'class' => 'input',
                'id' => 'number',
                'name' => 'number',
                'value' => '42',
            )
        );
    }

    public function testRangeField()
    {
        $html = TbHtml::rangeField(
            'range',
            3.33,
            array(
                'class' => 'input',
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=range]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'class' => 'input',
                'id' => 'range',
                'name' => 'range',
                'value' => '3.33',
            )
        );
    }

    public function testDateField()
    {
        $html = TbHtml::dateField(
            'date',
            '2013-07-27',
            array(
                'class' => 'input',
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=date]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'class' => 'input',
                'id' => 'date',
                'name' => 'date',
                'value' => '2013-07-27',
            )
        );
    }

    public function testTextArea()
    {
        $html = TbHtml::textArea(
            'textArea',
            'Textarea text',
            array(
                'class' => 'textarea',
            )
        );
        $textarea = $this->codeGuy->createNode($html, 'textarea');
        $this->codeGuy->seeNodeAttributes(
            $textarea,
            array(
                'class' => 'textarea',
                'id' => 'textArea',
                'name' => 'textArea',
            )
        );
        $this->codeGuy->seeNodeText($textarea, 'Textarea text');
    }

    public function testRadioButton()
    {
        $html = TbHtml::radioButton(
            'radio',
            false,
            array(
                'class' => 'input',
                'label' => 'Label text',
            )
        );
        $label = $this->codeGuy->createNode($html, 'label');
        $this->codeGuy->seeNodeCssClass($label, 'radio');
        $radio = $label->filter('label > input[type=radio]');
        $this->codeGuy->seeNodeAttributes(
            $radio,
            array(
                'class' => 'input',
                'id' => 'radio',
                'name' => 'radio',
                'value' => '1',
            )
        );
        $this->codeGuy->seeNodePattern($label, '/> Label text$/');
    }

    public function testCheckBox()
    {
        $html = TbHtml::checkBox(
            'checkbox',
            false,
            array(
                'class' => 'input',
                'label' => 'Label text',
            )
        );
        $label = $this->codeGuy->createNode($html, 'label');
        $this->codeGuy->seeNodeCssClass($label, 'checkbox');
        $checkbox = $label->filter('label > input[type=checkbox]');
        $this->codeGuy->seeNodeAttributes(
            $checkbox,
            array(
                'class' => 'input',
                'id' => 'checkbox',
                'name' => 'checkbox',
                'value' => '1',
            )
        );
        $this->codeGuy->seeNodePattern($label, '/> Label text$/');
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
        $html = TbHtml::uneditableField(
            'Uneditable text',
            array(
                'class' => 'span',
            )
        );
        $span = $this->codeGuy->createNode($html, 'span.uneditable-input');
        $this->codeGuy->seeNodeCssClass($span, 'span');
        $this->codeGuy->seeNodeText($span, 'Uneditable text');
    }

    public function testSearchQueryField()
    {
        $html = TbHtml::searchQueryField(
            'search',
            'Search query',
            array(
                'class' => 'input',
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=text].search-query');
        $this->codeGuy->seeNodeCssClass($input, 'input');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'id' => 'search',
                'name' => 'search',
                'value' => 'Search query',
            )
        );
    }

    public function testControlGroup()
    {
        $html = TbHtml::controlGroup(
            TbHtml::INPUT_TYPE_TEXT,
            'text',
            '',
            array(
                'color' => TbHtml::INPUT_COLOR_SUCCESS,
                'groupOptions' => array('class' => 'group'),
                'label' => 'Label text',
                'labelOptions' => array('class' => 'label'),
                'help' => 'Help text',
                'helpOptions' => array('class' => 'help'),
            )
        );
        $group = $this->codeGuy->createNode($html, 'div.control-group');
        $this->codeGuy->seeNodeCssClass($group, 'success group');
        $this->codeGuy->seeNodeChildren($group, array('label.control-label', 'div.controls'));
        $label = $group->filter('div.control-group > label.control-label');
        $this->codeGuy->seeNodeCssClass($label, 'label');
        $this->codeGuy->seeNodeAttribute($label, 'for', 'text');
        $this->codeGuy->seeNodeText($label, 'Label text');
        $controls = $group->filter('div.control-group > div.controls');
        $this->codeGuy->seeNodeChildren($controls, array('input', 'span'));
        $input = $controls->filter('input[type=text]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'id' => 'text',
                'name' => 'text',
                'value' => '',
            )
        );
        $help = $controls->filter('span.help-inline');
        $this->codeGuy->seeNodeCssClass($help, 'help');
        $this->codeGuy->seeNodeText($help, 'Help text');

        $html = TbHtml::controlGroup(
            TbHtml::INPUT_TYPE_RADIOBUTTON,
            'radio',
            true,
            array(
                'label' => 'Label text',
            )
        );
        $group = $this->codeGuy->createNode($html, 'div.control-group');
        $this->codeGuy->seeNodeChildren($group, array('div.controls'));
        $controls = $group->filter('div.control-group > div.controls');
        $label = $controls->filter('div.controls > label.radio');
        $this->codeGuy->seeNodePattern($label, '/> Label text$/');
        $radio = $label->filter('label > input[type=radio]');
        $this->codeGuy->seeNodeAttributes(
            $radio,
            array(
                'checked' => 'checked',
                'id' => 'radio',
                'name' => 'radio',
                'value' => '1',
            )
        );
    }

    public function testCustomControlGroup()
    {
        $html = TbHtml::customControlGroup(
            '<div class="widget"></div>',
            'custom',
            array(
                'label' => false,
            )
        );
        $group = $this->codeGuy->createNode($html, 'div.control-group');
        $controls = $group->filter('div.control-group > div.controls');
        $this->codeGuy->seeNodeChildren($controls, array('div.widget'));
    }

    public function testActiveTextField()
    {
        $html = TbHtml::activeTextField(
            new Dummy,
            'text',
            array(
                'class' => 'input'
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=text]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'class' => 'input',
                'id' => 'Dummy_text',
                'name' => 'Dummy[text]',
                'value' => 'text',
            )
        );

        $html = TbHtml::activeTextField(
            new Dummy,
            'text',
            array(
                'prepend' => 'Prepend text',
            )
        );
        $div = $this->codeGuy->createNode($html, 'div');
        $this->codeGuy->seeNodeCssClass($div, 'input-prepend');
        $this->codeGuy->seeNodeChildren($div, array('span.add-on', 'input'));
        $span = $div->filter('div > span.add-on');
        $this->codeGuy->seeNodeText($span, 'Prepend text');

        $html = TbHtml::activeTextField(
            new Dummy,
            'text',
            array(
                'append' => 'Append text',
            )
        );
        $div = $this->codeGuy->createNode($html, 'div');
        $this->codeGuy->seeNodeCssClass($div, 'input-append');
        $this->codeGuy->seeNodeChildren($div, array('input', 'span'));
        $span = $div->filter('div > span.add-on');
        $this->codeGuy->seeNodeText($span, 'Append text');

        $html = TbHtml::activeTextField(
            new Dummy,
            'text',
            array(
                'prepend' => 'Prepend text',
                'append' => 'Append text',
            )
        );
        $div = $this->codeGuy->createNode($html, 'div');
        $this->codeGuy->seeNodeCssClass($div, 'input-prepend input-append');
        $this->codeGuy->seeNodeChildren($div, array('span.add-on', 'input', 'span.add-on'));
    }

    public function testActivePasswordField()
    {
        $html = TbHtml::activePasswordField(
            new Dummy,
            'password',
            array(
                'class' => 'input'
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=password]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'class' => 'input',
                'id' => 'Dummy_password',
                'name' => 'Dummy[password]',
                'value' => 'secret',
            )
        );
    }

    public function testActiveUrlField()
    {
        $html = TbHtml::activeUrlField(
            new Dummy,
            'url',
            array(
                'class' => 'input'
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=url]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'class' => 'input',
                'id' => 'Dummy_url',
                'name' => 'Dummy[url]',
                'value' => 'http://www.getyiistrap.com',
            )
        );
    }

    public function testActiveEmailField()
    {
        $html = TbHtml::activeEmailField(
            new Dummy,
            'email',
            array(
                'class' => 'input'
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=email]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'class' => 'input',
                'id' => 'Dummy_email',
                'name' => 'Dummy[email]',
                'value' => 'christoffer.niska@gmail.com',
            )
        );
    }

    public function testActiveNumberField()
    {
        $html = TbHtml::activeNumberField(
            new Dummy,
            'number',
            array(
                'class' => 'input'
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=number]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'class' => 'input',
                'id' => 'Dummy_number',
                'name' => 'Dummy[number]',
                'value' => '42',
            )
        );
    }

    public function testActiveRangeField()
    {
        $html = TbHtml::activeRangeField(
            new Dummy,
            'range',
            array(
                'class' => 'input'
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=range]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'class' => 'input',
                'id' => 'Dummy_range',
                'name' => 'Dummy[range]',
                'value' => '3.33',
            )
        );
    }

    public function testActiveDateField()
    {
        $html = TbHtml::activeDateField(
            new Dummy,
            'date',
            array(
                'class' => 'input'
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=date]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'class' => 'input',
                'id' => 'Dummy_date',
                'name' => 'Dummy[date]',
                'value' => '2013-07-27',
            )
        );
    }

    public function testActiveTextArea()
    {
        $html = TbHtml::activeTextArea(
            new Dummy,
            'textarea',
            array(
                'class' => 'textarea',
            )
        );
        $textarea = $this->codeGuy->createNode($html, 'textarea');
        $this->codeGuy->seeNodeAttributes(
            $textarea,
            array(
                'class' => 'textarea',
                'id' => 'Dummy_textarea',
                'name' => 'Dummy[textarea]',
            )
        );
        $this->codeGuy->seeNodeText($textarea, 'Textarea text');
    }

    public function testActiveRadioButton()
    {
        $html = TbHtml::activeRadioButton(
            new Dummy,
            'radio',
            array(
                'class' => 'input',
                'label' => 'Label text',
            )
        );
        $label = $this->codeGuy->createNode($html, 'label');
        $this->codeGuy->seeNodeCssClass($label, 'radio');
        $this->codeGuy->seeNodeChildren($label, array('input[type=hidden]', 'input[type=radio]'));
        $hidden = $label->filter('label > input[type=hidden]');
        $this->codeGuy->seeNodeAttributes(
            $hidden,
            array(
                'id' => 'ytDummy_radio',
                'name' => 'Dummy[radio]',
                'value' => '0',
            )
        );
        $radio = $label->filter('label > input[type=radio]');
        $this->codeGuy->seeNodeAttributes(
            $radio,
            array(
                'class' => 'input',
                'checked' => 'checked',
                'id' => 'Dummy_radio',
                'name' => 'Dummy[radio]',
                'value' => '1',
            )
        );
        $this->codeGuy->seeNodePattern($label, '/> Label text$/');
    }

    public function testActiveCheckBox()
    {
        $html = TbHtml::activeCheckBox(
            new Dummy,
            'checkbox',
            array(
                'class' => 'input',
                'label' => 'Label text',
            )
        );
        $label = $this->codeGuy->createNode($html, 'label');
        $this->codeGuy->seeNodeCssClass($label, 'checkbox');
        $this->codeGuy->seeNodeChildren($label, array('input[type=hidden]', 'input[type=checkbox]'));
        $hidden = $label->filter('label > input[type=hidden]');
        $this->codeGuy->seeNodeAttributes(
            $hidden,
            array(
                'id' => 'ytDummy_checkbox',
                'name' => 'Dummy[checkbox]',
                'value' => '0',
            )
        );
        $checkbox = $label->filter('label > input[type=checkbox]');
        $this->codeGuy->seeNodeAttributes(
            $checkbox,
            array(
                'class' => 'input',
                'id' => 'Dummy_checkbox',
                'name' => 'Dummy[checkbox]',
                'value' => '1',
            )
        );
        $this->codeGuy->seeNodePattern($label, '/> Label text$/');
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
        $html = TbHtml::activeUneditableField(
            new Dummy,
            'uneditable',
            array(
                'class' => 'span'
            )
        );
        $span = $this->codeGuy->createNode($html, 'span.uneditable-input');
        $this->codeGuy->seeNodeCssClass($span, 'span');
        $this->codeGuy->seeNodeText($span, 'Uneditable text');
    }

    public function testActiveSearchQueryField()
    {
        $model = new Dummy;
        $html = TbHtml::activeSearchQueryField(
            $model,
            'search',
            array(
                'class' => 'input'
            )
        );
        $input = $this->codeGuy->createNode($html, 'input[type=text].search-query');
        $this->codeGuy->seeNodeCssClass($input, 'input');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'id' => 'Dummy_search',
                'name' => 'Dummy[search]',
                'value' => 'Search query',
            )
        );
    }

    public function testActiveControlGroup()
    {
        $html = TbHtml::activeControlGroup(
            TbHtml::INPUT_TYPE_TEXT,
            new Dummy,
            'text',
            array(
                'color' => TbHtml::INPUT_COLOR_ERROR,
                'groupOptions' => array('class' => 'group'),
                'labelOptions' => array('class' => 'label'),
                'help' => 'Help text',
                'helpOptions' => array('class' => 'help'),
            )
        );
        $group = $this->codeGuy->createNode($html, 'div.control-group');
        $this->codeGuy->seeNodeCssClass($group, 'error group');
        $this->codeGuy->seeNodeChildren($group, array('label.control-label', 'div.controls'));
        $label = $group->filter('div.control-group > label.control-label');
        $this->codeGuy->seeNodeCssClass($label, 'label');
        $this->codeGuy->seeNodeAttribute($label, 'for', 'Dummy_text');
        $this->codeGuy->seeNodeText($label, 'Text');
        $controls = $group->filter('div.control-group > div.controls');
        $this->codeGuy->seeNodeChildren($controls, array('input', 'span'));
        $input = $controls->filter('div.controls > input[type=text]');
        $this->codeGuy->seeNodeAttributes(
            $input,
            array(
                'id' => 'Dummy_text',
                'name' => 'Dummy[text]',
                'value' => 'text',
            )
        );
        $help = $controls->filter('div.controls > span.help-inline');
        $this->codeGuy->seeNodeCssClass($help, 'help');
        $this->codeGuy->seeNodeText($help, 'Help text');

        $html = TbHtml::activeControlGroup(
            TbHtml::INPUT_TYPE_RADIOBUTTON,
            new Dummy,
            'radio',
            array(
                'labelOptions' => array('class' => 'label'),
            )
        );
        $group = $this->codeGuy->createNode($html, 'div.control-group');
        $this->codeGuy->seeNodeChildren($group, array('div.controls'));
        $controls = $group->filter('div.control-group > div.controls');
        $label = $controls->filter('div.controls > label.radio');
        $this->codeGuy->seeNodePattern($label, '/> Radio$/');
        $this->codeGuy->seeNodeChildren($label, array('input[type=hidden]', 'input[type=radio]'));
        $hidden = $label->filter('label > input[type=hidden]');
        $this->codeGuy->seeNodeAttributes(
            $hidden,
            array(
                'id' => 'ytDummy_radio',
                'name' => 'Dummy[radio]',
                'value' => '0',
            )
        );
        $radio = $label->filter('label > input[type=radio]');
        $this->codeGuy->seeNodeAttributes(
            $radio,
            array(
                'checked' => 'checked',
                'id' => 'Dummy_radio',
                'name' => 'Dummy[radio]',
                'value' => '1',
            )
        );
    }

    public function testActiveCustomControlGroup()
    {
        $html = TbHtml::customActiveControlGroup(
            '<div class="widget"></div>',
            new Dummy,
            'text',
            array(
                'label' => false,
            )
        );
        $group = $this->codeGuy->createNode($html, 'div.control-group');
        $controls = $group->filter('div.control-group > div.controls');
        $this->codeGuy->seeNodeChildren($controls, array('div.widget'));
    }

    public function testErrorSummary()
    {
        // todo: write this.
    }

    public function testError()
    {
        $model = new Dummy;
        $model->addError('text', 'Error text');
        $html = TbHtml::error(
            $model,
            'text',
            array(
                'class' => 'error',
            )
        );
        $span = $this->codeGuy->createNode($html, 'span.help-inline');
        $this->codeGuy->seeNodeCssClass($span, 'error');
        $this->codeGuy->seeNodeText($span, 'Error text');
    }

    public function testControls()
    {
        $html = TbHtml::controls(
            '<div class="control"></div><div class="control"></div>',
            array(
                'before' => 'Before text',
                'after' => 'After text',
            )
        );
        $controls = $this->codeGuy->createNode($html, 'div.controls');
        $this->codeGuy->seeNodeChildren($controls, array('div.control', 'div.control'));
        $this->codeGuy->seeNodePattern($controls, '/^Before text</');
        $this->codeGuy->seeNodePattern($controls, '/>After text$/');
    }

    public function testControlsRow()
    {
        $html = TbHtml::controlsRow(
            array(
                '<div class="control"></div>',
                '<div class="control"></div>',
            )
        );
        $controls = $this->codeGuy->createNode($html, 'div.controls');
        $this->codeGuy->seeNodeChildren($controls, array('div.control', 'div.control'));
    }

    public function testFormActions()
    {
        $html = TbHtml::formActions('<div class="action"></div><div class="action"></div>');
        $this->assertEquals(
            '<div class="form-actions"><div class="action"></div><div class="action"></div></div>',
            $html
        );
        $actions = $this->codeGuy->createNode($html, 'div.form-actions');
        $this->codeGuy->seeNodeChildren($actions, array('div.action', 'div.action'));

        $html = TbHtml::formActions(
            array(
                '<div class="action"></div>',
                '<div class="action"></div>',
            )
        );
        $actions = $this->codeGuy->createNode($html, 'div.form-actions');
        $this->codeGuy->seeNodeChildren($actions, array('div.action', 'div.action'));
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
        $html = TbHtml::link(
            'Link',
            '#',
            array(
                'class' => 'link'
            )
        );
        $a = $this->codeGuy->createNode($html, 'a.link');
        $this->codeGuy->seeNodeAttribute($a, 'href', '#');
        $this->codeGuy->seeNodeText($a, 'Link');
    }

    public function testButton()
    {
        $html = TbHtml::button(
            'Button',
            array(
                'class' => 'button',
                'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                'size' => TbHtml::BUTTON_SIZE_LARGE,
                'block' => true,
                'disabled' => true,
                'loading' => 'Loading text',
                'toggle' => true,
                'icon' => TbHtml::ICON_CHECK
            )
        );
        $button = $this->codeGuy->createNode($html, 'button[type=button].btn');
        $this->codeGuy->seeNodeCssClass($button, 'btn-primary btn-large btn-block disabled button');
        $this->codeGuy->seeNodeAttributes(
            $button,
            array(
                'name' => 'yt0',
                'data-loading-text' => 'Loading text',
                'data-toggle' => 'button',
            )
        );
        $this->codeGuy->seeNodeChildren($button, array('i.icon-check'));
        $this->codeGuy->seeNodePattern($button, '/> Button$/');
        CHtml::$count = 0;
        // todo: test button dropdowns as well.
    }

    public function testHtmlButton()
    {
        $html = TbHtml::htmlButton(
            'Button',
            array(
                'class' => 'button',
            )
        );
        $button = $this->codeGuy->createNode($html, 'button[type=button].btn');
        $this->codeGuy->seeNodeCssClass($button, 'button');
        $this->codeGuy->seeNodeAttribute($button, 'name', 'yt0');
        $this->codeGuy->seeNodeText($button, 'Button');
        CHtml::$count = 0;
    }

    public function testSubmitButton()
    {
        $html = TbHtml::submitButton(
            'Submit',
            array(
                'class' => 'button'
            )
        );
        $button = $this->codeGuy->createNode($html, 'button[type=submit].btn');
        $this->codeGuy->seeNodeCssClass($button, 'button');
        $this->codeGuy->seeNodeAttribute($button, 'name', 'yt0');
        $this->codeGuy->seeNodeText($button, 'Submit');
        CHtml::$count = 0;
    }

    public function testResetButton()
    {
        $html = TbHtml::resetButton(
            'Reset',
            array(
                'class' => 'button',
            )
        );
        $button = $this->codeGuy->createNode($html, 'button[type=reset].btn');
        $this->codeGuy->seeNodeCssClass($button, 'button');
        $this->codeGuy->seeNodeAttribute($button, 'name', 'yt0');
        $this->codeGuy->seeNodeText($button, 'Reset');
        CHtml::$count = 0;
    }

    public function testImageButton()
    {
        $html = TbHtml::imageButton(
            'image.png',
            array(
                'class' => 'button',
            )
        );
        $button = $this->codeGuy->createNode($html, 'input[type=image].btn');
        $this->codeGuy->seeNodeCssClass($button, 'button');
        $this->codeGuy->seeNodeAttributes(
            $button,
            array(
                'name' => 'yt0',
                'src' => 'image.png',
                'value' => 'submit',
            )
        );
        CHtml::$count = 0;
    }

    public function testLinkButton()
    {
        $html = TbHtml::linkButton(
            'Link',
            array(
                'class' => 'button',
            )
        );
        $a = $this->codeGuy->createNode($html, 'a.btn');
        $this->codeGuy->seeNodeCssClass($a, 'button');
        $this->codeGuy->seeNodeAttribute($a, 'href', '#');
        $this->codeGuy->seeNodeText($a, 'Link');
    }

    public function testAjaxLink()
    {
        $html = TbHtml::ajaxLink(
            'Link',
            '#',
            array(), // todo: figure out a way to test the ajax options as well.
            array(
                'class' => 'button',
            )
        );
        $a = $this->codeGuy->createNode($html, 'a.btn');
        $this->codeGuy->seeNodeCssClass($a, 'button');
        $this->codeGuy->seeNodeAttributes(
            $a,
            array(
                'id' => 'yt0',
                'href' => '#',
            )
        );
        $this->codeGuy->seeNodeText($a, 'Link');
        CHtml::$count = 0;
    }

    public function testAjaxButton()
    {
        $html = TbHtml::ajaxButton(
            'Button',
            '#',
            array(),
            array(
                'class' => 'button',
            )
        );
        $button = $this->codeGuy->createNode($html, 'button[type=button].btn');
        $this->codeGuy->seeNodeCssClass($button, 'button');
        $this->codeGuy->seeNodeAttribute($button, 'id', 'yt0');
        $this->codeGuy->seeNodeText($button, 'Button');
        CHtml::$count = 0;
    }

    public function testAjaxSubmitButton()
    {
        $html = TbHtml::ajaxSubmitButton(
            'Submit',
            '#',
            array(),
            array(
                'class' => 'button',
            )
        );
        $button = $this->codeGuy->createNode($html, 'button[type=submit].btn');
        $this->codeGuy->seeNodeCssClass($button, 'button');
        $this->codeGuy->seeNodeAttributes(
            $button,
            array(
                'id' => 'yt0',
                'name' => 'yt0'
            )
        );
        $this->codeGuy->seeNodeText($button, 'Submit');
        CHtml::$count = 0;
    }

    public function testImageRounded()
    {
        $html = TbHtml::imageRounded(
            'image.png',
            'Alternative text',
            array(
                'class' => 'image',
            )
        );
        $img = $this->codeGuy->createNode($html, 'img.img-rounded');
        $this->codeGuy->seeNodeCssClass($img, 'image');
        $this->codeGuy->seeNodeAttributes(
            $img,
            array(
                'src' => 'image.png',
                'alt' => 'Alternative text',
            )
        );
    }

    public function testImageCircle()
    {
        $html = TbHtml::imageCircle(
            'image.png',
            'Alternative text',
            array(
                'class' => 'image',
            )
        );
        $img = $this->codeGuy->createNode($html, 'img.img-circle');
        $this->codeGuy->seeNodeCssClass($img, 'image');
        $this->codeGuy->seeNodeAttributes(
            $img,
            array(
                'src' => 'image.png',
                'alt' => 'Alternative text',
            )
        );
    }

    public function testImagePolaroid()
    {
        $html = TbHtml::imagePolaroid(
            'image.png',
            'Alternative text',
            array(
                'class' => 'image',
            )
        );
        $img = $this->codeGuy->createNode($html, 'img.img-polaroid');
        $this->codeGuy->seeNodeCssClass($img, 'image');
        $this->codeGuy->seeNodeAttributes(
            $img,
            array(
                'src' => 'image.png',
                'alt' => 'Alternative text',
            )
        );
    }

    public function testIcon()
    {
        $html = TbHtml::icon(
            TbHtml::ICON_CHECK,
            array(
                'class' => 'icon',
            )
        );
        $i = $this->codeGuy->createNode($html, 'i.icon-check');
        $this->codeGuy->seeNodeEmpty($i);

        $html = TbHtml::icon(
            TbHtml::ICON_REMOVE,
            array(
                'color' => TbHtml::ICON_COLOR_WHITE,
            )
        );
        $i = $this->codeGuy->createNode($html, 'i.icon-remove');
        $this->codeGuy->seeNodeCssClass($i, 'icon-white');
        $this->codeGuy->seeNodeEmpty($i);

        $html = TbHtml::icon('pencil white');
        $i = $this->codeGuy->createNode($html, 'i.icon-pencil');
        $this->codeGuy->seeNodeCssClass($i, 'icon-white');
        $this->codeGuy->seeNodeEmpty($i);
    }

    public function testDropdown()
    {
        // todo: write this.
    }

    public function testDropdownToggleLink()
    {
        $html = TbHtml::dropdownToggleLink(
            'Link',
            array(
                'class' => 'link',
            )
        );
        $a = $this->codeGuy->createNode($html, 'a.btn.dropdown-toggle');
        $this->codeGuy->seeNodeCssClass($a, 'link');
        $this->codeGuy->seeNodeAttributes(
            $a,
            array(
                'href' => '#',
                'data-toggle' => 'dropdown',
            )
        );
        $this->codeGuy->seeNodePattern($a, '/^Link </');
        $this->codeGuy->seeNodeChildren($a, array('b.caret'));
    }

    public function testDropdownToggleButton()
    {
        $html = TbHtml::dropdownToggleButton(
            'Button',
            array(
                'class' => 'button',
            )
        );
        $button = $this->codeGuy->createNode($html, 'button[type=button].btn.dropdown-toggle');
        $this->codeGuy->seeNodeCssClass($button, 'button');
        $this->codeGuy->seeNodeAttributes(
            $button,
            array(
                'name' => 'yt0',
                'data-toggle' => 'dropdown',
            )
        );
        $this->codeGuy->seeNodePattern($button, '/^Button </');
        $this->codeGuy->seeNodeChildren($button, array('b.caret'));
        CHtml::$count = 0;
    }

    public function testDropdownToggleMenuLink()
    {
        $html = TbHtml::dropdownToggleMenuLink(
            'Link',
            '#',
            array(
                'class' => 'link',
            )
        );
        $a = $this->codeGuy->createNode($html, 'a.dropdown-toggle');
        $this->codeGuy->seeNodeCssClass($a, 'link');
        $this->codeGuy->seeNodeAttributes(
            $a,
            array(
                'href' => '#',
                'data-toggle' => 'dropdown',
            )
        );
        $this->codeGuy->seeNodePattern($a, '/^Link </');
        $this->codeGuy->seeNodeChildren($a, array('b.caret'));
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
        $html = TbHtml::menuLink(
            'Link',
            '#',
            array(
                'class' => 'item',
                'linkOptions' => array('class' => 'link'),
            )
        );
        $li = $this->codeGuy->createNode($html, 'li');
        $this->codeGuy->seeNodeCssClass($li, 'item');
        $a = $li->filter('li > a');
        $this->codeGuy->seeNodeCssClass($a, 'link');
        $this->codeGuy->seeNodeAttribute($a, 'href', '#');
        $this->codeGuy->seeNodeText($a, 'Link');
    }

    public function testMenuDropdown()
    {
        // todo: write this.
    }

    public function testMenuHeader()
    {
        $html = TbHtml::menuHeader(
            'Header text',
            array(
                'class' => 'item',
            )
        );
        $li = $this->codeGuy->createNode($html, 'li.nav-header');
        $this->codeGuy->seeNodeCssClass($li, 'item');
        $this->codeGuy->seeNodeText($li, 'Header text');
    }

    public function testMenuDivider()
    {
        $html = TbHtml::menuDivider(
            array(
                'class' => 'item',
            )
        );
        $li = $this->codeGuy->createNode($html, 'li.divider');
        $this->codeGuy->seeNodeCssClass($li, 'item');
        $this->codeGuy->seeNodeEmpty($li);
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
        $html = TbHtml::navbar(
            'Navbar content',
            array(
                'class' => 'nav',
                'innerOptions' => array('class' => 'inner'),
            )
        );
        $navbar = $this->codeGuy->createNode($html, 'div.navbar');
        $this->codeGuy->seeNodeCssClass($navbar, 'nav');
        $inner = $navbar->filter('div.navbar > div.navbar-inner');
        $this->codeGuy->seeNodeText($inner, 'Navbar content');

        $html = TbHtml::navbar(
            '',
            array(
                'display' => TbHtml::NAVBAR_DISPLAY_STATICTOP,
            )
        );
        $navbar = $this->codeGuy->createNode($html, 'div.navbar');
        $this->codeGuy->seeNodeCssClass($navbar, 'navbar-static-top');

        $html = TbHtml::navbar(
            '',
            array(
                'display' => TbHtml::NAVBAR_DISPLAY_FIXEDTOP,
            )
        );
        $navbar = $this->codeGuy->createNode($html, 'div.navbar');
        $this->codeGuy->seeNodeCssClass($navbar, 'navbar-fixed-top');

        $html = TbHtml::navbar(
            '',
            array(
                'display' => TbHtml::NAVBAR_DISPLAY_FIXEDBOTTOM,
            )
        );
        $navbar = $this->codeGuy->createNode($html, 'div.navbar');
        $this->codeGuy->seeNodeCssClass($navbar, 'navbar-fixed-bottom');

        $html = TbHtml::navbar(
            '',
            array(
                'color' => TbHtml::NAVBAR_COLOR_INVERSE,
            )
        );
        $navbar = $this->codeGuy->createNode($html, 'div.navbar');
        $this->codeGuy->seeNodeCssClass($navbar, 'navbar-inverse');
    }

    public function testNavbarBrandLink()
    {
        $html = TbHtml::navbarBrandLink(
            'Brand text',
            '#',
            array(
                'class' => 'link',
            )
        );
        $a = $this->codeGuy->createNode($html, 'a.brand');
        $this->codeGuy->seeNodeCssClass($a, 'link');
        $this->codeGuy->seeNodeAttribute($a, 'href', '#');
        $this->codeGuy->seeNodeText($a, 'Brand text');
    }

    public function testNavbarText()
    {
        $html = TbHtml::navbarText(
            'Navbar text',
            array(
                'class' => 'text',
            )
        );
        $p = $this->codeGuy->createNode($html, 'p.navbar-text');
        $this->codeGuy->seeNodeCssClass($p, 'text');
        $this->codeGuy->seeNodeText($p, 'Navbar text');
    }

    public function testNavbarMenuDivider()
    {
        $html = TbHtml::navbarMenuDivider(
            array(
                'class' => 'item',
            )
        );
        $li = $this->codeGuy->createNode($html, 'li.divider-vertical');
        $this->codeGuy->seeNodeCssClass($li, 'item');
        $this->codeGuy->seeNodeEmpty($li);
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
        $html = TbHtml::paginationLink(
            'Link',
            '#',
            array(
                'class' => 'link',
                'itemOptions' => array('class' => 'item'),
            )
        );
        $li = $this->codeGuy->createNode($html, 'li');
        $this->codeGuy->seeNodeCssClass($li, 'item');
        $a = $li->filter('li > a');
        $this->codeGuy->seeNodeCssClass($a, 'link');
        $this->codeGuy->seeNodeAttribute($a, 'href', '#');
    }

    public function testPager()
    {
        // todo: write this.
    }

    public function testPagerLink()
    {
        $html = TbHtml::pagerLink(
            'Link',
            '#',
            array(
                'class' => 'link',
                'itemOptions' => array('class' => 'item'),
                'disabled' => true,
            )
        );
        $li = $this->codeGuy->createNode($html, 'li');
        $this->codeGuy->seeNodeCssClass($li, 'item disabled');
        $a = $li->filter('li > a');
        $this->codeGuy->seeNodeCssClass($a, 'link');
        $this->codeGuy->seeNodeAttribute($a, 'href', '#');
        $this->codeGuy->seeNodeText($a, 'Link');

        $html = TbHtml::pagerLink(
            'Previous',
            '#',
            array(
                'previous' => true,
            )
        );
        $li = $this->codeGuy->createNode($html, 'li.previous');
        $a = $li->filter('li > a');
        $this->codeGuy->seeNodeAttribute($a, 'href', '#');
        $this->codeGuy->seeNodeText($a, 'Previous');

        $html = TbHtml::pagerLink(
            'Next',
            '#',
            array(
                'next' => true,
            )
        );
        $li = $this->codeGuy->createNode($html, 'li.next');
        $a = $li->filter('li > a');
        $this->codeGuy->seeNodeAttribute($a, 'href', '#');
        $this->codeGuy->seeNodeText($a, 'Next');
    }

    public function testLabel()
    {
        $html = TbHtml::labelTb(
            'Label text',
            array(
                'color' => TbHtml::LABEL_COLOR_INFO,
                'class' => 'span',
            )
        );
        $span = $this->codeGuy->createNode($html, 'span.label');
        $this->codeGuy->seeNodeCssClass($span, 'label-info span');
        $this->codeGuy->seeNodeText($span, 'Label text');
    }

    public function testBadge()
    {
        $html = TbHtml::badge(
            'Badge text',
            array(
                'color' => TbHtml::BADGE_COLOR_WARNING,
                'class' => 'span',
            )
        );
        $span = $this->codeGuy->createNode($html, 'span.badge');
        $this->codeGuy->seeNodeCssClass($span, 'badge-warning span');
        $this->codeGuy->seeNodeText($span, 'Badge text');
    }

    public function testHeroUnit()
    {
        $html = TbHtml::heroUnit(
            'Heading text',
            'Content text',
            array(
                'class' => 'div',
                'headingOptions' => array('class' => 'heading'),
            )
        );
        $hero = $this->codeGuy->createNode($html, 'div.hero-unit');
        $this->codeGuy->seeNodeCssClass($hero, 'div');
        $this->codeGuy->seeNodeText($hero, 'Content text');
        $h1 = $hero->filter('div.hero-unit > h1');
        $this->codeGuy->seeNodeCssClass($h1, 'heading');
        $this->codeGuy->seeNodeText($h1, 'Heading text');
    }

    public function testPageHeader()
    {
        $html = TbHtml::pageHeader(
            'Heading text',
            'Subtext',
            array(
                'class' => 'header',
                'headerOptions' => array('class' => 'heading'),
                'subtextOptions' => array('class' => 'subtext')
            )
        );
        $header = $this->codeGuy->createNode($html, 'div.page-header');
        $this->codeGuy->seeNodeCssClass($header, 'header');
        $h1 = $header->filter('div.page-header > h1');
        $this->codeGuy->seeNodeCssClass($h1, 'heading');
        $this->codeGuy->seeNodeText($h1, 'Heading text');
        $small = $h1->filter('h1 > small');
        $this->codeGuy->seeNodeCssClass($small, 'subtext');
        $this->codeGuy->seeNodeText($small, 'Subtext');
    }

    public function testThumbnails()
    {
        // todo: write this.
    }

    public function testThumbnail()
    {
        $html = TbHtml::thumbnail(
            'Thumbnail text',
            array(
                'class' => 'div',
                'itemOptions' => array('class' => 'item'),
            )
        );
        $li = $this->codeGuy->createNode($html, 'li');
        $this->codeGuy->seeNodeCssClass($li, 'item');
        $thumbnail = $li->filter('li > div.thumbnail');
        $this->codeGuy->seeNodeCssClass($thumbnail, 'div');
        $this->codeGuy->seeNodeText($thumbnail, 'Thumbnail text');
    }

    public function testThumbnailLink()
    {
        $html = TbHtml::thumbnailLink(
            'Thumbnail text',
            '#',
            array(
                'class' => 'link',
                'itemOptions' => array('class' => 'item'),
            )
        );
        $li = $this->codeGuy->createNode($html, 'li');
        $this->codeGuy->seeNodeCssClass($li, 'item');
        $thumbnail = $li->filter('li > a.thumbnail');
        $this->codeGuy->seeNodeCssClass($thumbnail, 'link');
        $this->codeGuy->seeNodeAttribute($thumbnail, 'href', '#');
        $this->codeGuy->seeNodeText($thumbnail, 'Thumbnail text');
    }

    public function testAlert()
    {
        $html = TbHtml::alert(
            TbHtml::ALERT_COLOR_SUCCESS,
            'Alert message',
            array(
                'class' => 'div',
                'closeText' => 'Close',
                'closeOptions' => array('class' => 'text'),
            )
        );
        $alert = $this->codeGuy->createNode($html, 'div.alert');
        $this->codeGuy->seeNodeCssClass($alert, 'alert-success in fade div');
        $this->codeGuy->seeNodeText($alert, 'Alert message');
        $close = $alert->filter('div.alert > a[type=button].close');
        $this->codeGuy->seeNodeCssClass($close, 'text');
        $this->codeGuy->seeNodeAttributes(
            $close,
            array(
                'href' => '#',
                'data-dismiss' => 'alert',
            )
        );
        $this->codeGuy->seeNodeText($close, 'Close');

        $html = TbHtml::alert(
            TbHtml::ALERT_COLOR_INFO,
            'Alert message',
            array(
                'closeText' => false,
                'in' => false,
                'fade' => false,
            )
        );
        $alert = $this->codeGuy->createNode($html, 'div.alert');
        $this->codeGuy->seeNodeCssClass($alert, 'alert-info');
        $this->codeGuy->dontSeeNodeCssClass($alert, 'fade in');
        $this->codeGuy->dontSeeNodeChildren($alert, array('.close'));
        $this->codeGuy->seeNodeText($alert, 'Alert message');
    }

    public function testBlockAlert()
    {
        $html = TbHtml::blockAlert(TbHtml::ALERT_COLOR_WARNING, 'Alert message');
        $alert = $this->codeGuy->createNode($html, 'div.alert');
        $this->codeGuy->seeNodeCssClass($alert, 'alert-warning alert-block fade in');
        $this->codeGuy->seeNodeText($alert, 'Alert message');
        $this->codeGuy->seeNodeChildren($alert, array('div.alert > a[type=button].close'));
    }

    public function testProgressBar()
    {
        $html = TbHtml::progressBar(
            60,
            array(
                'class' => 'div',
                'color' => TbHtml::PROGRESS_COLOR_INFO,
                'content' => 'Bar text',
                'barOptions' => array('class' => 'div'),
            )
        );
        $progress = $this->codeGuy->createNode($html, 'div.progress');
        $this->codeGuy->seeNodeCssClass($progress, 'progress-info div');
        $bar = $progress->filter('div.progress > div.bar');
        $this->codeGuy->seeNodeCssClass($bar, 'div');
        $this->codeGuy->seeNodeCssStyle($bar, 'width: 60%');
        $this->codeGuy->seeNodeText($bar, 'Bar text');

        $html = TbHtml::progressBar(
            35,
            array(
                'barOptions' => array('color' => TbHtml::PROGRESS_COLOR_SUCCESS),
            )
        );
        $progress = $this->codeGuy->createNode($html, 'div.progress');
        $bar = $progress->filter('div.progress > div.bar');
        $this->codeGuy->seeNodeCssClass($bar, 'bar-success');
        $this->codeGuy->seeNodeCssStyle($bar, 'width: 35%');

        $html = TbHtml::progressBar(-1);
        $progress = $this->codeGuy->createNode($html, 'div.progress');
        $bar = $progress->filter('div.progress > div.bar');
        $this->codeGuy->seeNodeCssStyle($bar, 'width: 0');

        $html = TbHtml::progressBar(100.1);
        $progress = $this->codeGuy->createNode($html, 'div.progress');
        $bar = $progress->filter('div.progress > div.bar');
        $this->codeGuy->seeNodeCssStyle($bar, 'width: 100%');
    }

    public function testStripedProgressBar()
    {
        $html = TbHtml::stripedProgressBar(20);
        $progress = $this->codeGuy->createNode($html, 'div.progress');
        $this->codeGuy->seeNodeCssClass($progress, 'progress-striped');
        $bar = $progress->filter('div.progress > div.bar');
        $this->codeGuy->seeNodeCssStyle($bar, 'width: 20%');
    }

    public function testAnimatedProgressBar()
    {
        $html = TbHtml::animatedProgressBar(40);
        $progress = $this->codeGuy->createNode($html, 'div.progress');
        $this->codeGuy->seeNodeCssClass($progress, 'progress-striped active');
        $bar = $progress->filter('div.progress > div.bar');
        $this->codeGuy->seeNodeCssStyle($bar, 'width: 40%');
    }

    public function testStackedProgressBar()
    {
        $html = TbHtml::stackedProgressBar(
            array(
                array('color' => TbHtml::PROGRESS_COLOR_SUCCESS, 'width' => 35),
                array('color' => TbHtml::PROGRESS_COLOR_WARNING, 'width' => 20),
                array('color' => TbHtml::PROGRESS_COLOR_DANGER, 'width' => 10),
            )
        );
        $progress = $this->codeGuy->createNode($html, 'div.progress');
        $this->codeGuy->seeNodeChildren($progress, array('div.bar-success', 'div.bar-warning', 'div.bar-danger'));
        $success = $progress->filter('div.progress > div.bar-success');
        $this->codeGuy->seeNodeCssClass($success, 'bar');
        $this->codeGuy->seeNodeCssStyle($success, 'width: 35%');
        $warning = $progress->filter('div.progress > div.bar-warning');
        $this->codeGuy->seeNodeCssClass($warning, 'bar');
        $this->codeGuy->seeNodeCssStyle($warning, 'width: 20%');
        $danger = $progress->filter('div.progress > div.bar-danger');
        $this->codeGuy->seeNodeCssClass($danger, 'bar');
        $this->codeGuy->seeNodeCssStyle($danger, 'width: 10%');

        $html = TbHtml::stackedProgressBar(
            array(
                array('width' => 35),
                array('width' => 20),
                array('width' => 100),
            )
        );
        $progress = $this->codeGuy->createNode($html, 'div.progress');
        $last = $progress->filter('div.progress > div.bar:last-child');
        $this->codeGuy->seeNodeCssStyle($last, 'width: 45%');

        $html = TbHtml::stackedProgressBar(
            array(
                array('width' => 35),
                array('width' => 20),
                array('width' => 10, 'visible' => false),
            )
        );
        $progress = $this->codeGuy->createNode($html, 'div.progress');
        $last = $progress->filter('div.progress > div.bar:last-child');
        $this->codeGuy->seeNodeCssStyle($last, 'width: 20%');
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
        $html = TbHtml::well(
            'Well text',
            array(
                'class' => 'div',
                'size' => TbHtml::WELL_SIZE_LARGE,
            )
        );
        $well = $this->codeGuy->createNode($html, 'div.well');
        $this->codeGuy->seeNodeCssClass($well, 'well-large');
        $this->codeGuy->seeNodeText($well, 'Well text');
    }

    public function testCloseLink()
    {
        $html = TbHtml::closeLink(
            'Close',
            '#',
            array(
                'class' => 'link',
                'dismiss' => TbHtml::CLOSE_DISMISS_ALERT,
            )
        );
        $a = $this->codeGuy->createNode($html, 'a[type=button].close');
        $this->codeGuy->seeNodeCssClass($a, 'link');
        $this->codeGuy->seeNodeAttributes(
            $a,
            array(
                'href' => '#',
                'data-dismiss' => 'alert',
            )
        );
        $this->codeGuy->seeNodeText($a, 'Close');
    }

    public function testCloseButton()
    {
        $html = TbHtml::closeButton(
            'Close',
            array(
                'dismiss' => TbHtml::CLOSE_DISMISS_MODAL,
                'class' => 'button',
            )
        );
        $button = $this->codeGuy->createNode($html, 'button[type=button].close');
        $this->codeGuy->seeNodeCssClass($button, 'button');
        $this->codeGuy->seeNodeAttribute($button, 'data-dismiss', 'modal');
        $this->codeGuy->seeNodeText($button, 'Close');
    }


    public function testCollapseLink()
    {
        $html = TbHtml::collapseLink(
            'Link',
            '#',
            array(
                'class' => 'link',
            )
        );
        $a = $this->codeGuy->createNode($html, 'a[data-toggle=collapse]');
        $this->codeGuy->seeNodeCssClass($a, 'link');
        $this->codeGuy->seeNodeAttribute($a, 'href', '#');
        $this->codeGuy->seeNodeText($a, 'Link');
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
        $html = TbHtml::carouselPrevLink(
            'Previous',
            '#',
            array(
                'class' => 'link',
            )
        );
        $a = $this->codeGuy->createNode($html, 'a.carousel-control.left');
        $this->codeGuy->seeNodeCssClass($a, 'link');
        $this->codeGuy->seeNodeAttributes(
            $a,
            array(
                'href' => '#',
                'data-slide' => 'prev',
            )
        );
        $this->codeGuy->seeNodeText($a, 'Previous');
    }

    public function testCarouselNextLink()
    {
        $html = TbHtml::carouselNextLink(
            'Next',
            '#',
            array(
                'class' => 'link',
            )
        );
        $a = $this->codeGuy->createNode($html, 'a.carousel-control.right');
        $this->codeGuy->seeNodeCssClass($a, 'link');
        $this->codeGuy->seeNodeAttributes(
            $a,
            array(
                'href' => '#',
                'data-slide' => 'next',
            )
        );
        $this->codeGuy->seeNodeText($a, 'Next');
    }

    public function testCarouselIndicators()
    {
        $html = TbHtml::carouselIndicators(
            '#',
            3,
            array(
                'class' => 'list',
            )
        );
        $ol = $this->codeGuy->createNode($html, 'ol.carousel-indicators');
        $this->codeGuy->seeNodeCssClass($ol, 'list');
        $this->codeGuy->seeNodeChildren($ol, array('li.active', 'li', 'li'));
        $first = $ol->filter('ol > li:first-child');
        $this->codeGuy->seeNodeAttributes(
            $first,
            array(
                'data-target' => '#',
                'data-slide-to' => '0'
            )
        );
        $this->codeGuy->seeNodeEmpty($first);
        $second = $ol->filter('ol > li:nth-child(2)');
        $this->codeGuy->seeNodeAttributes(
            $second,
            array(
                'data-target' => '#',
                'data-slide-to' => '1'
            )
        );
        $this->codeGuy->seeNodeEmpty($second);
        $third = $ol->filter('ol > li:nth-child(3)');
        $this->codeGuy->seeNodeAttributes(
            $third,
            array(
                'data-target' => '#',
                'data-slide-to' => '2'
            )
        );
        $this->codeGuy->seeNodeEmpty($third);
    }
}