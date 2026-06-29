<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Contact;

use Estratos\DomainApiInterface\DTO\Contact;
use Estratos\DomainApiInterface\Request\AddContactRequest;
use Estratos\DomainApiInterface\Request\UpdateContactRequest;

interface ContactProviderInterface
{
    /**
     * List all contacts in the account.
     * @return Contact[]
     */
    public function list(): array;
    
    /**
     * Add a new contact.
     */
    public function add(AddContactRequest $request): Contact;
    
    /**
     * Update an existing contact.
     */
    public function update(UpdateContactRequest $request): Contact;
    
    /**
     * Delete a contact.
     */
    public function delete(string $contactId): bool;
}
