<?php

namespace App\Http\Services;

use App\Exceptions\SensorException;
use App\Http\Requests\SensorRequest;
use App\Models\Sensor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class SensorService
{
    public function create(SensorRequest $request): Sensor
    {
        try{
            return Sensor::create($request->validated());
        } catch (QueryException $e) {
            switch ($e->getCode()) {
                case 23505:
                    throw new SensorException('Sensor already exists', 409);
                    break;

                case 23502:
                    throw new SensorException("Incorrets nulls values", 400);
                    break;

                case 22000:
                    throw new SensorException("Invalids types in array", 400);
                    break;

                default:
                    throw new SensorException("Error creating sensor", 500);
                    break;
            }
        } catch (\Exception $exception) {
            throw new SensorException("Error creating sensor", 500);
        }
    }

    public function findAll(): Collection {
        return Sensor::query()->orderByDesc('created_at')->get();
    }

    public function findById(string $id): Sensor
    {
        try {
            return Sensor::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            throw new SensorException("Sensor not found", 404);
        } catch (\Exception $exception) {
            throw new SensorException("Error finding sensor", 500);
        }
    }

    public function update(string $id, SensorRequest $request): Sensor
    {
        try{
            $sensor = $this->findById($id);
            $sensor->update($request->validated());
            $sensor->saveOrFail();
            return $sensor;

        } catch (QueryException $e) {
            switch ($e->getCode()) {
                case 23505:
                    throw new SensorException('Sensor already exists', 409);
                    break;

                case 23502:
                    throw new SensorException("Incorrets nulls values", 400);
                    break;

                case 22000:
                    throw new SensorException("Invalids types in array", 400);
                    break;

                default:
                    throw new SensorException("Error creating sensor", 500);
                    break;
            }
        } catch (\Exception $exception) {
            throw new SensorException("Error creating sensor", 500);
        }
    }

    public function patch(string $id, array $fields): Sensor
    {
        try{
            $sensor = $this->findById($id);
            $sensor->update($fields);
            $sensor->saveOrFail();
            return $sensor;

        } catch (QueryException $e) {
            switch ($e->getCode()) {
                case 23505:
                    throw new SensorException('Sensor already exists', 409);
                    break;

                case 23502:
                    throw new SensorException("Incorrets nulls values", 400);
                    break;

                case 22000:
                    throw new SensorException("Invalids types in array", 400);
                    break;

                default:
                    throw new SensorException("Error creating sensor", 500);
                    break;
            }
        } catch (\Exception $exception) {
            throw new SensorException("Error creating sensor", 500);
        }
    }

    public function deleteById(string $id) :void {
        Sensor::find($id)?->delete();
    }
}
