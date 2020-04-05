<?php

namespace Encore\Admin\Show;

class Divider extends Field
{
    protected $title;

    public function __construct($title = '')
    {
        $this->title = $title;
    }

    public function render()
    {
        return <<<HTML
<tr>
    <td bgcolor="#bcc5cd" colspan="2" class="text-left">
        <strong>{$this->title}</strong>
    </td>
</tr>
HTML;
    }
}
