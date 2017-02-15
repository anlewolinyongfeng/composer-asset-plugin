<?php

/*
 * This file is part of the Fxp Composer Asset Plugin package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Composer\AssetPlugin\Repository;

use Fxp\Composer\AssetPlugin\Assets;
use Fxp\Composer\AssetPlugin\Util\AssetPlugin;

/**
 * Factory of default repository registries.
 *
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
class DefaultRegistryFactory implements RegistryFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public static function create(AssetRepositoryManager $arm, VcsPackageFilter $filter, array $extra)
    {
        $rm = $arm->getRepositoryManager();

        foreach (Assets::getDefaultRegistries() as $assetType => $registryClass) {
            $config = AssetPlugin::createRepositoryConfig($arm, $filter, $extra, $assetType);

            $rm->setRepositoryClass($assetType, $registryClass);
            $rm->addRepository($rm->createRepository($assetType, $config));
        }
    }
}
