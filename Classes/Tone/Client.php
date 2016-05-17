<?php
namespace Ttree\Watson\Tone;

/*
 * This file is part of the Ttree.Watson package.
 *
 * (c) Build with love by ttree agency - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Ttree\Watson\AbstractClient;

/**
 * Tone Analyzer Client
 */
class Client extends AbstractClient
{
    const URI = 'tone-analyzer-beta/api/v3/tone?version=2016-02-11';

    /**
     * @param string $text
     * @return string
     */
    public function analyze($text)
    {
        $response = $this->request('POST', self::URI, [
            'body' => json_encode([
                'text' => $text
            ])
        ]);
        return $response->getBody();
    }
}
