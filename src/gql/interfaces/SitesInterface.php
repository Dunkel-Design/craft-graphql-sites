<?php

namespace dunkel\graphqlsites\gql\interfaces;

use Craft;
use craft\gql\GqlEntityRegistry;
use GraphQL\Type\Definition\InterfaceType;
use GraphQL\Type\Definition\Type;
use dunkel\graphqlsites\gql\types\SitesType;

class SitesInterface {
	/**
	 * @inheritdoc
	 */
	public static function getType($fields = null): Type {
		if ($type = GqlEntityRegistry::getEntity(self::getName())) {
			return $type;
		}

		$type = GqlEntityRegistry::createEntity(self::getName(), new InterfaceType([
			'name' => static::getName(),
			'fields' => self::class . '::getFieldDefinitions',
			'description' => 'This is the interface implemented by all sites.',
			'resolveType' => function(mixed $value) {
				return SitesType::getName();
			},
		]));

		GqlEntityRegistry::createEntity(SitesType::getName(), new SitesType([
			'name' => SitesType::getName(),
			'fields' => self::class . '::getFieldDefinitions'
		]));

		return $type;
	}

	/**
	 * @inheritdoc
	 */
	public static function getName(): string {
		return 'SitesInterface';
	}

	/**
	 * @inheritdoc
	 */
	public static function getFieldDefinitions(): array {
		return Craft::$app->getGql()->prepareFieldDefinitions([
			'id' => [
				'name' => 'id',
				'type' => Type::int(),
				'description' => 'Site ID'
			],
			'baseUrl' => [
				'name' => 'baseUrl',
				'type' => Type::string(),
				'description' => 'Site Base URL',
			],
			'language' => [
				'name' => 'language',
				'type' => Type::string(),
				'description' => 'Site Language',
			]
		], self::getName());
	}
}