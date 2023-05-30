<?php

namespace dunkel\graphqlsites\gql\types;

use dunkel\graphqlsites\gql\interfaces\SitesInterface;

use craft\gql\base\ObjectType;

use GraphQL\Type\Definition\ResolveInfo;

class SitesType extends ObjectType {
	public function __construct(array $config) {
		$config['interfaces'] = [
			SitesInterface::getType(),
		];

		parent::__construct($config);
	}

	public static function getName(): string {
		return 'SitesType';
	}

	protected function resolve(mixed $source, array $arguments, mixed $context, ResolveInfo $resolveInfo): mixed {
		return $source[$resolveInfo->fieldName] ?? null;
	}
}