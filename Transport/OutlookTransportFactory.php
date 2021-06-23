<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Mailer\Bridge\Outlook\Transport;

use Symfony\Component\Mailer\Exception\UnsupportedSchemeException;
use Symfony\Component\Mailer\Transport\AbstractTransportFactory;
use Symfony\Component\Mailer\Transport\Dsn;
use Symfony\Component\Mailer\Transport\TransportInterface;

/**
 * @author Konstantin Myakshin <molodchick@gmail.com>
 */
final class OutlookTransportFactory extends AbstractTransportFactory
{
    public function create(Dsn $dsn): TransportInterface
    {
        if (\in_array($dsn->getScheme(), $this->getSupportedSchemes())) {
            return new OutlookSmtpTransport($this->getUser($dsn), $this->getPassword($dsn), $this->dispatcher, $this->logger);
        }

        throw new UnsupportedSchemeException($dsn, 'outlook', $this->getSupportedSchemes());
    }

    protected function getSupportedSchemes(): array
    {
        return ['outlook'];
    }
}
