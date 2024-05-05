<?php
namespace Requests;

use Exception;
use Traits\Validator;

class RestAdvisorRequest
{
    use Validator;
    protected array $source = [];
    protected array $params = [];
    public function __construct(array $source)
    {
        $this->source = $source;
        $this->validate();
    }

    protected function rules(): array
    {
        return [
            'required' => [
                'participant_count',
                'rest_type',
                'sender',
            ],
            'integer' => [
                'participant_count',
            ],
            'string' => [
                'rest_type',
                'sender',
            ],
            'match' => [
                'rest_type' => [
                    'education',
                    'recreational',
                    'social',
                    'diy',
                    'charity',
                    'cooking',
                    'relaxation',
                    'music',
                    'busywork'
                ],
                'sender' => [
                    'file',
                    'console'
                ],
            ],
            'range' => [
                'participant_count' => [
                    'min' => 1,
                    'max' => 8
                ]
            ]
        ];
    }

    protected function parseParams(): void
    {
        foreach ($this->source as $item) {
            if (str_starts_with($item, '--')) {
                $param = str_replace('--', '', $item);
                $paramComponent = explode('=', $param);
                if (!isset($paramComponent[0]) || !isset($paramComponent[1])) {
                    continue;
                }
                $this->params[$paramComponent[0]] = $paramComponent[1];
            }
        }
    }

    /**
     * @throws Exception
     */
    protected function validate(): void
    {
        $this->parseParams();
        $this->checkRules($this->rules()['required'], function ($field) {
            if (!$this->requiredValidator($this->params, $field)) {
                throw new Exception("$field is required param\n");
            }
        });
        $this->checkRules($this->rules()['integer'], function ($field) {
            if (!$this->integerValidator($this->params, $field)) {
                throw new Exception("$field mast be integer\n");
            }
        });
        $this->checkRules($this->rules()['string'], function ($field) {
            if (!$this->stringValidator($this->params, $field)) {
                throw new Exception("$field mast be string\n");
            }
        });
        $this->checkRules($this->rules()['match'], function ($allowed, $key) {
            if (!$this->matchValidator($allowed, $this->params[$key])) {
                throw new Exception("$key parameter mast be in: \n\n\t". implode("\n\t", $allowed));
            }
        });
        $this->checkRules($this->rules()['range'], function ($range, $key) {
            if (!$this->rangeValidator($range['min'], $range['max'], $this->params[$key])) {
                throw new Exception("$key parameter mast be between {$range['min']} and {$range['max']}");
            }
        });
    }

    public function getParticipantCount(): ?int
    {
        return $this->params['participant_count'] ?? null;
    }

    public function getRestType(): ?string
    {
        return $this->params['rest_type'] ?? null;
    }

    public function getSender(): ?string
    {
        return $this->params['sender'] ?? null;
    }
}