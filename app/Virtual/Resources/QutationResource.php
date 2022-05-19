<?php
/**
 * @OA\Schema(
 *     title="QutationResource",
 *     description="Qutation resource",
 *     @OA\Xml(
 *         name="QutationResource"
 *     )
 * )
 */
class QutationResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Qutation
     */
    private $data;
}
