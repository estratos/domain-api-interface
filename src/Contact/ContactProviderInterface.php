<?php

declare(strict_types=1);

namespace Estratos\DomainApiInterface\Contact;

use Estratos\DomainApiInterface\DTO\Contact;
use Estratos\DomainApiInterface\Exception\ProviderException;
use Estratos\DomainApiInterface\Request\AddContactRequest;
use Estratos\DomainApiInterface\Request\UpdateContactRequest;

/**
 * Contact management for the registrar account.
 */
interface ContactProviderInterface
{
    /**
     * List all contacts in the account.
     *
     * @throws ProviderException when the listing fails
     * @return Contact[]
     */
    public function list(): array;

    /**
     * Add a new contact.
     *
     * @throws ProviderException when the contact cannot be created
     */
    public function add(AddContactRequest $request): Contact;

    /**
     * Update an existing contact.
     *
     * @throws ProviderException when the contact cannot be updated
     */
    public function update(UpdateContactRequest $request): Contact;

    /**
     * Delete a contact.
     *
     * @throws ProviderException when the contact cannot be deleted
     * @return bool true when the contact was deleted
     */
    public function delete(string $contactId): bool;
}
