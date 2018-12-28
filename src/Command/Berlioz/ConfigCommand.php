<?php
/**
 * This file is part of Berlioz framework.
 *
 * @license   https://opensource.org/licenses/MIT MIT License
 * @copyright 2018 Ronan GIRON
 * @author    Ronan GIRON <https://github.com/ElGigi>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code, to the root.
 */

declare(strict_types=1);

namespace Berlioz\CliCore\Command\Berlioz;

use Berlioz\CliCore\App\CliArgs;
use Berlioz\CliCore\Command\AbstractCommand;
use Berlioz\CliCore\Command\CommandArg;
use Berlioz\Core\Core;
use Berlioz\Core\CoreAwareInterface;
use Berlioz\Core\CoreAwareTrait;

/**
 * Class ConfigCommand.
 *
 * @package Berlioz\CliCore\Command\Berlioz
 */
class ConfigCommand extends AbstractCommand implements CoreAwareInterface
{
    use CoreAwareTrait;

    /**
     * CacheClearCommand constructor.
     *
     * @param \Berlioz\Core\Core $core
     */
    public function __construct(Core $core)
    {
        $this->setCore($core);
    }

    /**
     * @inheritdoc
     */
    public static function getDescription(): ?string
    {
        return 'Show merged JSON configuration';
    }

    /**
     * @inheritdoc
     */
    public function getArgs(): array
    {
        return [new CommandArg('f', 'filter', 'Filter', true)];
    }

    /**
     * @inheritdoc
     * @throws \Berlioz\Config\Exception\ConfigException
     * @throws \Berlioz\Core\Exception\BerliozException
     */
    public function run(CliArgs $args)
    {
        if (!is_string($filter = $args->getOptionValue('f', 'filter')) || empty($filter)) {
            $filter = null;
        }

        print json_encode($this->getCore()->getConfig()->get($filter), JSON_PRETTY_PRINT);
    }
}