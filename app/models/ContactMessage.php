<?php
require_once APP_ROOT . '/app/models/Model.php';

class ContactMessage extends Model {
    protected static string $table = 'contact_messages';
}
