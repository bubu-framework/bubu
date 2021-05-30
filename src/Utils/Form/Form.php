<?php

namespace Bubu\Utils\Form;

use Bubu\DevTools\Dump;

class Form
{

    // Build parts
    public Input $input;
    public Textarea $textarea;
    public Label $label;
    public Button $button;
    public Select $select;
    private array $elements = [];
    private array $formAttributes = [];

    public function __construct()
    {
        $this->input    = new Input();
        $this->textarea = new Textarea();
        $this->label    = new Label();
        $this->button   = new Button();
        $this->select   = new Select();
    }

    // Form attributes
    public array $novalidate   = ['boolAttribute' => 'novalidate'];
    public array $autocomplete = ['autocomplete' => 'on'];

    // Form attributes methods
    
    /**
     * acceptCharset
     *
     * @param  string $charsets
     * @return self
     */
    public function acceptCharset(string $charsets): self
    {
        $this->formAttributes[] = ['accept-charset' => $charsets];
        return $this;
    }

    /**
     * action
     *
     * @param  string $action
     * @return self
     */
    public function action(string $action): self
    {
        $this->formAttributes[] = ['action' => $action];
        return $this;
    }

    /**
     * method
     *
     * @param  string $method
     * @return self
     */
    public function method(string $method): self
    {
        $this->formAttributes[] = ['method' => $method];
        return $this;
    }

    /**
     * name
     *
     * @param  string $name
     * @return self
     */
    public function name(string $name): self
    {
        $this->formAttributes[] = ['name' => $name];
        return $this;
    }

    /**
     * target
     *
     * @param  string $target
     * @return self
     */
    public function target(string $target): self
    {
        $this->formAttributes[] = ['target' => $target];
        return $this;
    }

    /**
     * enctype
     *
     * @param  string $enctype
     * @return self
     */
    public function enctype(string $enctype): self
    {
        $this->formAttributes[] = ['enctype' => $enctype];
        return $this;
    }

    // Build part

    public function add(array $add): self
    {
        switch (key($add)) {
            case 'input':
                $element = '<input --ATTRIBUTES-- />';
                break;

            case 'textarea':
                $element = '<textarea --ATTRIBUTES--></textarea>';
                break;

            case 'label':
                $element = '<label --ATTRIBUTES--></label>';
                break;

            case 'button':
                $element = '<button --ATTRIBUTES--></button>';
                break;

            case 'select':
                $element = '<select --ATTRIBUTES--></select>';
                break;
        }
        $attributes = '';
        foreach ($add[key($add)] as $value) {
            foreach ($value as $key => $value) {
                if (
                    $key === 'value'
                    && (
                        key($add) === 'textarea'
                        || key($add) === 'label'
                        || key($add) === 'button'
                        || key($add) === 'select'
                    )
                ) {
                    $key2 = key($add);
                    $element = str_replace("</{$key2}>", $value . "</{$key2}>", $element);
                } elseif ($key !== 'boolAttribute') {
                    $attributes .= "{$key}=\"{$value}\" ";
                } else {
                    $attributes .= "{$value} ";
                }
            }
        }
        $this->elements[] = str_replace('--ATTRIBUTES--', $attributes, $element);
        return $this;
    }

    public function build(): string
    {
        $formAttributes = '';
        foreach ($this->formAttributes as $key => $value) {
            $index = key($value);
            $value = $value[key($value)];
            if ($key !== 'boolAttribute') {
                $formAttributes .= "{$index}=\"{$value}\" ";
            } else {
                $formAttributes .= "{$value} ";
            }
        }
        return '<form ' . $formAttributes . '>' . implode($this->elements) . '</form>';
    }
}
