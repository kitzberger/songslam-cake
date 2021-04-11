<?php
declare(strict_types=1);

namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Mailer\Mailer;
use Cake\Validation\Validator;

class SlamSuggestForm extends Form
{
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema
            ->addField('name', 'string')
            ->addField('email', ['type' => 'string'])
            ->addField('slamname', 'string')
            ->addField('slamcity', 'string')
            ->addField('slaminfo', ['type' => 'text']);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notBlank('name')
            ->email('email')
            ->notBlank('slamname')
            ->notBlank('slamcity')
            ->notBlank('slaminfo');

        return $validator;
    }

    protected function _execute(array $data): bool
    {
        // Send an email.

        $mailer = new Mailer('default');
        $mailer->setFrom([env('EMAIL_SENDER_MAIL') => env('EMAIL_SENDER_NAME')])
            ->setTo(env('EMAIL_RECIPIENT'))
            ->setSubject('Slam suggestion')
            ->deliver(print_r($data, true));

        return true;
    }
}
