import axios from 'axios'
import $rules from '@/assets/rules'
import { debounce } from 'ts-debounce'
import { useRouter } from 'next/router'
import { Clients } from '@/types/Clients'
import { FC, useEffect, useState } from 'react'
import {
  AutoComplete,
  Button,
  Card,
  DatePicker,
  Empty,
  Form,
  FormInstance,
  FormListFieldData,
  FormListOperation,
  Input,
  InputNumber,
  Popconfirm,
  Select,
  Space,
  Table,
  Typography,
} from 'antd'
import { showError } from '@/assets/utils'
import { DeleteOutlined } from '@ant-design/icons'
import { Product } from '@/types/Product'
import $filtros from '@/assets/filtros'
import dayjs from 'dayjs'
const { TextArea } = Input

const addConcepto = () => ({
  product: '',
  description: '',
  amount: 1,
  unit_value: 0,
  discount: 0,
  importe: 0,
})

export const Conceptos: FC<{
  form: FormInstance
}> = (props) => {
  const [optionsProducts, setOptionsProducts] = useState<any[]>([])

  const detalles: ReturnType<typeof addConcepto>[] =
    Form.useWatch('details', props.form) || []

  useEffect(() => {
    if (detalles.length === 0) {
      props.form.setFieldValue('details', [addConcepto()])
    }
    axios.get('/api/products/').then(({ data }) => {
      const products = data.map((item: Product) => ({
        ...item,
        value: item.code,
        label: item.name,
      }))
      setOptionsProducts(products)
    })
  }, [])

  const getTablaDetalle = (
    fields: FormListFieldData[],
    operation: FormListOperation,
    form: FormInstance
  ) => {
    const updateTotals = debounce(() => {
      try {
        const details = form.getFieldValue('details')
        for (const detalle of details) {
          detalle.importe =
            detalle.amount * detalle.unit_value -
            (detalle.discount ? detalle.discount : 0)
        }
        form.setFieldValue('details', details)
      } catch (error) {
        console.warn('Calculo de totales:', error)
      }
    }, 300)

    const onSelectProduct = (
      value: string,
      val: Partial<Product> = {},
      index: number
    ) => {
      const name = ['details', index]
      const dataAnterior = form.getFieldValue(name)
      if (val) {
        Object.assign(dataAnterior, {
          code: val?.code,
          description: val.description,
          unit_value: val.price || 0,
        })
      }
      form.setFieldValue(name, dataAnterior)
      updateTotals()
    }

    return (
      <Table
        bordered
        dataSource={fields}
        rowClassName="align-top"
        pagination={false}
        className="mb-6"
      >
        <Table.Column
          key="product"
          title="Producto"
          render={({ name }) => (
            <AutoComplete
              className="w-full"
              options={optionsProducts}
              placeholder="Seleccione un producto"
              filterOption={(inputValue, option) =>
                option!.value
                  .toUpperCase()
                  .indexOf(inputValue.toUpperCase()) !== -1
              }
              onSelect={(value, option) => onSelectProduct(value, option, name)}
            />
          )}
        />
        <Table.Column
          key="description"
          title="Descripción"
          render={({ name }) => (
            <Form.Item name={[name, 'description']} rules={[$rules.required()]}>
              <Input placeholder="Descripción del producto o servicio" />
            </Form.Item>
          )}
        />
        <Table.Column
          key="amount"
          title="Cantidad"
          render={({ name }) => (
            <Form.Item name={[name, 'amount']} rules={[$rules.required()]}>
              <InputNumber
                className="w-full"
                precision={2}
                min={0}
                placeholder="Ingrese la cantidad"
                onChange={() => updateTotals()}
              />
            </Form.Item>
          )}
        />
        <Table.Column
          key="unit_value"
          title="Valor u."
          render={({ name }) => (
            <Form.Item name={[name, 'unit_value']} rules={[$rules.required()]}>
              <InputNumber
                className="w-full"
                precision={2}
                min={0}
                placeholder="Ingrese el valor unitario"
                onChange={() => updateTotals()}
              />
            </Form.Item>
          )}
        />
        <Table.Column
          key="discount"
          title="Descuento"
          render={({ name }) => (
            <Form.Item name={[name, 'discount']}>
              <InputNumber
                className="w-full"
                precision={2}
                min={0}
                placeholder="Ingrese el descuento"
                onChange={() => updateTotals()}
              />
            </Form.Item>
          )}
        />
        <Table.Column
          key="importe"
          title="Importe"
          render={({ name }) => (
            <Form.Item name={[name, 'importe']} rules={[$rules.required()]}>
              <InputNumber
                className="w-full"
                disabled
                precision={2}
                min={0}
                placeholder="Ingrese el importe"
              />
            </Form.Item>
          )}
        />
        <Table.Column
          key="opciones"
          align="center"
          render={({ name }) => (
            <Popconfirm
              title="¿Eliminar detalle?"
              onConfirm={() => operation.remove(name)}
            >
              <DeleteOutlined title="Eliminar detalle" />
            </Popconfirm>
          )}
        />
      </Table>
    )
  }

  return (
    <>
      <Form.List name="details">
        {(fields, operation) => (
          <>
            <div className="flex justify-end mb-5">
              <Button
                type="link"
                onClick={() => {
                  operation.add(addConcepto())
                }}
              >
                Agregar
              </Button>
            </div>
            {(detalles || [])?.length === 0 ? (
              <Empty description="No hay detalles" />
            ) : (
              getTablaDetalle(fields, operation, props.form)
            )}
          </>
        )}
      </Form.List>
    </>
  )
}

const SalesNotes: FC = () => {
  const router = useRouter()
  const [form] = Form.useForm()
  const [optionsClients, setOptionsClients] = useState<any[]>([])
  type TabsKeys = 'detalles'
  const [tabActiva, setTabActiva] = useState<TabsKeys>('detalles')
  const detalles = Form.useWatch('details', form) || []
  // const [subTotals, setSubTotals] = useState([])

  useEffect(() => {
    if (router.query.id) {
      axios.get(`/api/sales-note/${router.query.id}`).then(({ data }) => {
        if (data.client) {
          const cliente = optionsClients.filter(
            (x: Clients) => x._id === data.client
          )
          if (cliente && cliente.length > 0) {
            data.client = cliente[0].identification_card
            form.setFieldValue('cliente', data.client)
            form.setFieldValue('name', cliente[0].name)
            form.setFieldValue('email', cliente[0].email)
          }
        }
        form.setFieldsValue(data)
      })
    }
  }, [router.query.id, optionsClients])

  useEffect(() => {
    axios.get('/api/clients/').then(({ data }) => {
      const clients = data.map((item: Clients) => ({
        ...item,
        value: item.identification_card,
        label: item.name,
      }))
      setOptionsClients(clients)
    })
  }, [])

  const onSubmit = async (data: any) => {
    data.date = data.date.toISOString()
    console.log(data)
    // try {
    //   if (router.query.id) {
    //     await axios.put(`/api/sales-note/${router.query.id}`, data)
    //     message.success('Documento actualizado')
    //   } else {
    //     await axios.post('/api/sales-note', data)
    //     message.success('Documento guardado correctamente')
    //   }
    //   router.push('/app/salesNotes')
    // } catch (err) {
    //   showError(err)
    // }
  }

  const onSelect = (data: string, option: Clients) => {
    form.setFieldValue('client', option._id)
    form.setFieldValue('name', option.name)
    form.setFieldValue('email', option.email)
  }

  const cssColumnas = 'grid grid-cols-1 md:grid-cols-3 gap-x-6'

  interface Total {
    label: string
    total: number
  }

  const getSubTotals = () => {
    let sumaSubtotal = 0
    let totalIva = 0
    let sumaDescuento = 0
    for (const detalle of detalles) {
      sumaSubtotal += detalle.importe
      sumaDescuento += detalle.discount
    }
    const subtotal: Total[] = [{ label: 'Subtotal', total: sumaSubtotal }]
    form.setFieldValue('subtotal', sumaSubtotal)
    if (sumaDescuento > 0) {
      subtotal.push({
        label: 'Descuento',
        total: sumaDescuento,
      })
      form.setFieldValue('discount', sumaDescuento)
    }
    if (sumaSubtotal > 0) {
      totalIva = sumaSubtotal * 0.12
      subtotal.push({
        label: 'IVA 12%',
        total: totalIva,
      })
      form.setFieldValue('iva', totalIva)
    }
    if (sumaSubtotal > 0 && totalIva > 0) {
      subtotal.push({
        label: 'Total',
        total: sumaSubtotal + totalIva,
      })
      form.setFieldValue('total', sumaSubtotal + totalIva)
    }
    return subtotal
  }

  const subTotals = getSubTotals()

  return (
    <Form
      form={form}
      layout="vertical"
      onFinish={onSubmit}
      initialValues={{
        date: dayjs(),
        forma_pago: 'efectivo',
      }}
    >
      <Card>
        <div className={cssColumnas}>
          <Form.Item
            name="invoice_number"
            label="Nº comprobante"
            rules={[$rules.required()]}
          >
            <Input placeholder="Ingrese el número de comprobante" />
          </Form.Item>
          <Form.Item name="date" label="Fecha">
            <DatePicker className="w-full" />
          </Form.Item>
          <Form.Item
            name="forma_pago"
            label="Forma de pago"
            rules={[$rules.required()]}
          >
            <Select
              placeholder="Escoja una de las opciones"
              options={[
                {
                  label: 'Efectivo',
                  value: 'efectivo',
                },
                {
                  label: 'Transferencia',
                  value: 'transferencia',
                },
                {
                  label: 'Tarjeta de crédito',
                  value: 'tarjeta',
                },
                {
                  label: 'Cheque',
                  value: 'cheque',
                },
              ]}
            />
          </Form.Item>
        </div>
      </Card>
      <Card className="mt-4 mb-4">
        <Typography.Title level={4}>Información cliente</Typography.Title>
        <div className={cssColumnas}>
          <Form.Item name="cliente" label="Cliente" rules={[$rules.required()]}>
            <AutoComplete
              options={optionsClients}
              placeholder="Seleccione un cliente"
              filterOption={(inputValue, option) =>
                option!.value
                  .toUpperCase()
                  .indexOf(inputValue.toUpperCase()) !== -1
              }
              onSelect={(value, option) => onSelect(value, option)}
            />
          </Form.Item>
          <Form.Item name="client" className="hidden">
            <Input type="hidden" />
          </Form.Item>
          <Form.Item name="name" label="Razón social">
            <Input placeholder="Ingrese el nombre" />
          </Form.Item>
          <Form.Item name="email" label="Email">
            <Input placeholder="Ingrese el correo" />
          </Form.Item>
        </div>
      </Card>
      <Card
        tabList={[{ key: 'detalles', tab: 'Detalles' }]}
        activeTabKey={tabActiva}
        onTabChange={(key) => setTabActiva(key as TabsKeys)}
      >
        <div className={tabActiva === 'detalles' ? '' : 'hidden'}>
          <Conceptos form={form} />
        </div>
      </Card>
      <Card className="mb-6">
        <div className="grid grid-flow-row-dense grid-cols-2 xl:grid-cols-3 md:grid-flow-col-dense sm:grid-flow-col-dense gap-x-6">
          <div className="col-span-2">
            <Form.Item name="observations" label="Observaciones">
              <TextArea placeholder="Ingrese alguna observación" rows={3} />
            </Form.Item>
          </div>
          <div className="col-span-2">
            <Form.Item label="Totales">
              <div>
                <table className="border w-full">
                  <tbody>
                    {subTotals.map((x: Total, index: number) => (
                      <tr key={'subtotal' + index}>
                        <th className="text-left border p-2">{x.label}</th>
                        <td className="text-right border p-2">
                          {$filtros.currency(x.total)}
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </Form.Item>
          </div>
        </div>
      </Card>
      <Form.Item name="total" noStyle>
        <Input type="hidden" />
      </Form.Item>
      <Form.Item name="subtotal" noStyle>
        <Input type="hidden" />
      </Form.Item>
      <Form.Item name="iva" noStyle>
        <Input type="hidden" />
      </Form.Item>
      <Form.Item name="discount" noStyle>
        <Input type="hidden" />
      </Form.Item>
      <Space className="mt-4 flex justify-end mr-4">
        <Button type="primary" className=" bg-blue-400" htmlType="submit">
          Guardar
        </Button>
        <Button className="ml-3" onClick={() => router.push('/app/salesNotes')}>
          Cancelar
        </Button>
      </Space>
    </Form>
  )
}

export default SalesNotes
